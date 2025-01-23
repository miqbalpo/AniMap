<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-transparent mx-auto text-white">
        <div id="anime-list-section" class="mx-auto">
            <h1 class="mb-4 fw-semibold text-center">Anime List</h1>
            <div id="anime-selection" class="d-flex justify-content-center my-4">
                <button class="btn mx-3">All Anime</button>
                <button class="btn mx-3">Liked</button>
                <button class="btn mx-3">Plan to Watch</button>
                <button class="btn mx-3">Currently Watching</button>
                <button class="btn mx-3">Disliked</button>
                <button class="btn mx-3">Won't Watch</button>
            </div>
            <div class="bg-transparent mx-auto" style="width: 90%; min-height: 70vh;">
                <table id="anime-list-table" class="table text-start" style="width: 100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Premiered</th>
                            <th>Type</th>
                            <th>Studios</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td></td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011-04-25</td>
                            <td>$320,800</td>
                            <td><button class="btn">View Details</button></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011-07-25</td>
                            <td>$170,750</td>
                            <td><button class="btn">View Details</button></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009-01-12</td>
                            <td>$86,000</td>
                            <td><button class="btn">View Details</button></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009-01-12</td>
                            <td>$86,000</td>
                            <td><button class="btn">View Details</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main-layout>
