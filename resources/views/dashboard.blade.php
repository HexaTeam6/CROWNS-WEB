<x-app-layout>	
	<x-slot name="slot">
		@include('components.header')
		<!-- Page content -->
		<div class="container-fluid mt--6">
			@include('components.footer')
		</div>
	</x-slot>
</x-app-layout>
