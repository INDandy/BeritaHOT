<nav id="Navbar" class="max-w-[1130px] mx-auto flex justify-between items-center mt-[30px]">
		<div class="logo-container flex gap-[30px] items-center">
			<a href="{{route('front.index')}}" class="flex shrink-0">
				<img src="{{asset('assets/images/logos/logo.png')}}" alt="logo" />
			</a>
			{{-- <a href="/admin"
			class="px-5 py-2 rounded-full text-white bg-[#FF6B18] font-semibold text-sm mt-4">
			ADMIN PANEL
			</a> --}}
			<div class="h-12 border border-[#E8EBF4]"></div>
			<form method="GET" action="{{route('front.search')}}"
				class="w-[450px] flex items-center rounded-full border border-[#E8EBF4] p-[12px_20px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FF6B18] transition-all duration-300">

				@csrf
				<button type="submit" class="w-5 h-5 flex shrink-0">
					<img src="{{asset('assets/images/icons/search-normal.svg')}}" alt="icon" />
				</button>
				<input type="text" name="keyword" id=""
					class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#A3A6AE]"
					placeholder="Search hot trendy news today..." />
			</form>
		</div>
		<div class="flex items-center gap-3">
		</div>
	</nav>