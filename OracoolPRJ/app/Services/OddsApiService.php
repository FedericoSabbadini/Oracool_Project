<?php

namespace App\Services;

use App\Models\EventFootball;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OddsApiService
{
    //protected $apiKey = 'f0e597500ec08145bb2212147b7a81b7';
    protected $apiKey = '32e3a7b42b51a4b4c0f749690e5d51aa';
    protected $baseUrl = 'https://api.the-odds-api.com/v4/sports';

    /**
     * Recupera le quote per gli eventi di calcio
     *
     * @param string $league
     * @return array
     */
    public function getFootballOdds($league)
    {
        try {
            $response = Http::get($this->baseUrl . '/' . $league . '/odds', [
                'api_key' => $this->apiKey,
                'regions' => 'eu',
                'markets' => 'h2h,spreads,totals',
                'dateFormat' => 'iso'
            ]);

            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Errore API quote: ' . $response->status() . ' - ' . $response->body());
            return [];
        } catch (\Exception $e) {
            Log::error('Errore nel recupero delle quote: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Aggiorna le quote per gli eventi esistenti
     *
     * @param string $league
     * @return array Informazioni sull'aggiornamento
     */
    public function updateEventsOdds($league)
    {
        Log::info('Inizio aggiornamento quote per la lega: ' . $league);
        $apiData = $this->getFootballOdds($league);
        $updatedCount = 0;
        $matchedByTeams = 0;
        $foundApiEvents = count($apiData);

        Log::info('Eventi trovati dall\'API: ' . $foundApiEvents);

        if (empty($apiData)) {
            Log::error('Nessun dato ricevuto dall\'API');
            return [
                'updated' => 0,
                'api_events' => 0,
                'matched_by_teams' => 0,
                'db_events' => EventFootball::count(),
                'error' => 'Nessun dato ricevuto dall\'API'
            ];
        }

        $allEvents = EventFootball::where('status', 'scheduled')->get();
        Log::info('Eventi trovati nel database: ' . $allEvents->count());
        foreach ($allEvents as $event) {
            $homeTeam = $event->home_team;
            $awayTeam = $event->away_team;
                        
            // Cerca questo evento nei dati dell'API
            $matchingApiEvent = collect($apiData)->first(function($apiEvent) use ($homeTeam, $awayTeam) {
            return $apiEvent['home_team'] === $homeTeam && $apiEvent['away_team'] === $awayTeam;
            });
            
            if ($matchingApiEvent) {
            $matchedByTeams++;
            $odds = $this->calculateAverageOdds($matchingApiEvent, $homeTeam, $awayTeam);
            
            // Aggiorna le quote nel database
            $event->quote_1 = $odds['quote1'];
            $event->quote_X = $odds['quoteX'];
            $event->quote_2 = $odds['quote2'];
            $event->save();
            
            $updatedCount++;
            Log::info("Quote aggiornate per l'evento: $homeTeam vs $awayTeam");
            } else {
            Log::info("Nessun dato API trovato per l'evento: $homeTeam vs $awayTeam");
            }
        }

        return [
            'updated' => $updatedCount,
            'api_events' => $foundApiEvents,
            'matched_by_teams' => $matchedByTeams,
            'db_events' => $allEvents->count()
        ];
    }


    /**
     * Calcola la media delle quote dai dati dell'API
     *
     * @param array $eventData
     * @param string $homeTeam
     * @param string $awayTeam
     * @return array
     */
    private function calculateAverageOdds($eventData, $homeTeam, $awayTeam)
    {
        $quote1 = $quoteX = $quote2 = 0;
        $count1 = $countX = $count2 = 0;
        
        foreach ($eventData['bookmakers'] as $bookmaker) {
            if (!isset($bookmaker['markets'])) {
                continue;
            }
            
            foreach ($bookmaker['markets'] as $market) {
                if ($market['key'] != 'h2h' || !isset($market['outcomes'])) {
                    continue;
                }
                
                foreach ($market['outcomes'] as $outcome) {

                    if ($outcome['name'] == $homeTeam) {
                        $quote1 += $outcome['price'];
                        $count1++;
                    } elseif ($outcome['name'] == 'Draw') {
                        $quoteX += $outcome['price'];
                        $countX++;
                    } elseif ($outcome['name'] == $awayTeam) {
                        $quote2 += $outcome['price'];
                        $count2++;
                    }
                }
            }
        }

        // Calcola la media delle quote solo se ci sono quote per l'esito
        $avgQuote1 = $count1 > 0 ? $quote1 / $count1 : 0;
        $avgQuoteX = $countX > 0 ? $quoteX / $countX : 0;
        $avgQuote2 = $count2 > 0 ? $quote2 / $count2 : 0;
        
        return [
            'quote1' => $avgQuote1,
            'quoteX' => $avgQuoteX,
            'quote2' => $avgQuote2,
        ];
    }
    

}