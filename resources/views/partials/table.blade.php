<table style="width:100%">
	<caption>{{ $messages->count() }} messages found</caption>

	<thead>
		<tr>
			<th class="text-center">User</th>
			<th class="text-center">Originating country</th>
			<th class="text-center">Sell amount</th>
			<th class="text-center">Buy amount</th>
			<th class="text-center">Rate</th>
			<th class="text-center">Placed at</th>
			<th class="text-center">Received at</th>
			<th class="text-center">Processed at</th>
		</tr>
	</thead>

	<tbody>
		@foreach($messages as $message)
		<tr>
			<!--User-->
			<td class="text-center">
				<abbr title="{{ $message->user->email }}">{{ $message->user }}</abbr>
			</td>

			<!--Originating country-->
			<td class="text-center">
				<abbr title="{{ $message->country->code }}">{{ $message->country }}</abbr>
			</td>

			<!--Sell amount-->
			<td class="text-center">
				{!! currency($message->fromCurrency, $message->amount_sell) !!}
			</td>

			<!--Buy amount-->
			<td class="text-center">
				{!! currency($message->toCurrency, $message->amount_buy) !!}
			</td>

			<!--Rate-->
			<td class="text-center">
				{{ $message->getRate() }}
			</td>

			<!--Placed at-->
			<td class="text-center">
				{!! date_for_humans($message->placed_at) !!}
			</td>

			<!--Received at-->
			<td class="text-center">
				{!! date_for_humans($message->created_at) !!}
			</td>

			<!--Processed at-->
			<td class="text-center">
				@if ($message->processed_at)
					{!! date_for_humans($message->processed_at) !!}
				@else
					<span class="radius alert label">Pending</span>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{!! $pagination->render() !!}
