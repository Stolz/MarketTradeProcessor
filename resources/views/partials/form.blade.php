<form action="/" method="post">
	<fieldset>
		<legend>Add message</legend>

		@if ($errors->any())
				<div data-alert class="alert-box alert radius">
				@foreach ($errors->all() as $error)
					{{ $error }}<br>
				@endforeach
				<!--<a href="#" class="close">&times;</a>-->
			</div>
		@endif

		<div class="row">
			<div class="medium-6 columns">
				<label for="userId">User</label>
				{!! dropdown('userId', $users) !!}
			</div>
			<div class="medium-6 columns">
				<label for="originatingCountry">Originating country</label>
				{!! dropdown('originatingCountry', $countries) !!}
			</div>
		</div>

		<div class="row">
			<div class="medium-6 columns">
				<label for="currencyFrom">From currency</label>
				{!! dropdown('currencyFrom', $currencies) !!}
			</div>
			<div class="medium-6 columns">
				<label for="currencyTo">To currency</label>
				{!! dropdown('currencyTo', $currencies) !!}
			</div>
		</div>

		<div class="row">
			<div class="medium-6 columns">
				<label for="amountSell">Sell amount</label>
				<input type="number" name="amountSell" min="1" step="0.1" value="{{ old('amountSell') }}">
			</div>
			<div class="medium-6 columns">
				<label for="amountBuy">Buy amount</label>
				<input type="number" name="amountBuy" min="1" step="0.1" value="{{ old('amountBuy') }}">
			</div>
		</div>


		<div class="row">
			<div class="medium-6 columns">
				<label for="rate">Rate</label>
				<input type="number" name="rate" min="0.001" step="0.001" value="{{ old('rate') }}">
			</div>
			<div class="medium-6 columns">
				<label for="timePlaced">Placed at</label>
				<input type="text" name="timePlaced" value="{{ old('timePlaced') }}" placeholder="YYYY-MM-DD hh:mm:ss">
			</div>
		</div>

		<input type="submit" value="Submit" class="button expand">

	</fieldset>
</form>


