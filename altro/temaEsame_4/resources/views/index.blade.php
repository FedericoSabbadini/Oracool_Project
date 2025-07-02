@extends('layouts.master')

    @section('body')

        <script>
            $('document').ready(function() {
                $('.open-modal').on('click', function() {
                    $.ajax({
                        url: '{{ route('home.create') }}',
                        type: 'GET',
                        success: function(data) {
                            html = '<h5>Teams</h5>';
                            html += '<ul class="list-group">';
                            data.teams.forEach(function(team) {
                                html += '<li class="list-group-item">' + team.nome + ' - PPG= ' + team.punteggioMedio + '</li>';
                            });
                            html += '</ul>';
                            
                            $('#modalTeam .modal-body').html(html);
                        }
                    });
                });
            });
        </script>

        <section class="bg-light py-5 px-5">

            <div class="row align-items-center justify-content-center">
                <div class="col-4 text-center">
                    <button class="btn btn-primary btn-block mb-4" onclick="location.href='{{ route('home.store') }}'">Initialize</button>
                    @php 
                        if ($teams && $btn==1) {
                            foreach ($teams as $team) {
                                echo "<p>Team: " . $team->nome . ", Punteggio: " . $team->punteggio . "</p>";
                            }
                        }
                    @endphp
                </div>
                <div class="col-4 text-center">
                    <button class="btn btn-primary btn-block mb-4" onclick="location.href='{{ route('home.delete') }}'">Reset</button>
                    @php 
                        if ($teams && $btn==2) {
                            foreach ($teams as $team) {
                                echo "<p>Team: " . $team->nome . "</p>";
                            }
                        }
                    @endphp
                </div>
                <div class="col-4 text-center">
                    <button class="btn btn-primary btn-block mb-4 open-modal" data-bs-toggle="modal" data-bs-target="#modalTeam">Show</button>

                </div>

            </div>

        </section>

        <div class="modal fade" id="modalTeam" tabindex="-1" role="dialog" aria-labelledby="modalTeamLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTeamLabel">Team Details</h5>
                    </div>
                    <div class="modal-body">

                    </div>

                </div>
            </div>
        </div>
        
    @endsection