<table class="table-fixed w-full">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $key => $transaction)
        <tr>
            <td class="border px-4 py-2">{{ ++$key }}</td>
            <td class="border px-4 py-2">{{ date('Y-m-d h:i:s', $transaction->created ) }}</td>
            <td class="border px-4 py-2">{{ ($transaction->amount / 100) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
