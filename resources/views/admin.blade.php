<x-layout>
    <x-slot name="content">
        <div id="container">
            <link rel="stylesheet" href="admin.css">
            <button id="push-button">Benachrichtigungen aktivieren</button>
            <h1>Bestellungen - übersicht</h1>
            <table id="orders">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Pieces</td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Adress</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>DE-25652</td>
                    <td>1x MXF (brown/l); 2x SME (black/xs)</td>
                    <td>John Doe</td>
                    <td>accepted</td>
                    <td>Example Street 4, 48151 Example</td>
                    <td><a href=".">Open</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <script src="../push.js" type="module"></script>
        <script src="../admin.js"></script>
    </x-slot>
</x-layout>
