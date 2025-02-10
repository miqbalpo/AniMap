<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-search-layout></x-search-layout>
    <div class="bg-transparent mx-auto text-white">
        <div id="anime-list-section" class="mx-auto">
            <h1 class="mb-4 fw-semibold text-center">Anime List</h1>
            <div id="anime-selection" class="d-flex justify-content-center my-4">
                <button class="btn mx-3 active" data-status="all">All Anime</button>
                <button class="btn mx-3" data-status="liked">Liked</button>
                <button class="btn mx-3" data-status="plan to watch">Plan to Watch</button>
                <button class="btn mx-3" data-status="currently watching">Currently Watching</button>
                <button class="btn mx-3" data-status="disliked">Disliked</button>
                <button class="btn mx-3" data-status="won't watch">Won't Watch</button>
            </div>
            <div class="bg-transparent mx-auto my-5" style="width: 90%; min-height: 70vh;">
                <table id="anime-list-table" class="table text-start align-middle" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Premiered</th>
                            <th>Type</th>
                            <th>Studios</th>
                            <th>Status</th>
                            <th style="visibility: hidden;"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="anime-list-body">
                        @foreach ($animeData as $anime)
                        <tr data-status="{{ $anime['status'] }}">
                            <td>
                                <img src="{{ $anime['thumbnail'] }}" alt="Thumbnail" width="50">
                            </td>
                            <td>{{ $anime['title'] }}</td>
                            <td>{{ $anime['score'] }}</td>
                            <td>{{ $anime['premiered'] }}</td>
                            <td>{{ $anime['type'] }}</td>
                            <td>{{ $anime['studios'] }}</td>
                            <td>{{ $anime['status'] }}</td>
                            <td>
                                <a href="{{ route('anime-info', ['id' => $anime['mal_id']]) }}" class="btn">View Details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function () {
            const dataTable = $('#anime-list-table').DataTable({
                pageLength: 10,
                columnDefs: [{
                    orderable: false, targets: 0
                }]
            });

            // Set the "All" button as active by default
            $('#anime-selection .btn[data-status="all"]').addClass('active');

            // Custom filtering function
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    const selectedStatus = $('#anime-selection .btn.active').data('status') || 'all';
                    const rowStatus = $(dataTable.row(dataIndex).node()).data('status').toLowerCase().trim();

                    if (selectedStatus === 'all') {
                        return true; // Show all rows
                    } else {
                        return rowStatus === selectedStatus; // Show rows that match the selected status
                    }
                }
            );

            const buttons = document.querySelectorAll('#anime-selection .btn');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    // Remove active class from all buttons and add to the clicked button
                    buttons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Redraw the DataTable to apply the custom filter
                    dataTable.draw();
                });
            });
        });
    </script>
</x-main-layout>
