@extends('front.master')
@section('content')
<body class="font-[Poppins] pb-[83px]">
	<x-navbar/>
    <nav id="Category" class="max-w-[1130px] mx-auto flex justify-center items-center gap-4 mt-[30px]">

            @foreach ($categories as $item_category)
            
			<a href="{{route('front.category', $item_category->slug)}}" class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
				<div class="w-6 h-6 flex shrink-0">
					<img src="{{Storage::url($item_category->icon)}}" alt="icon" />
				</div>
				<span>{{$item_category->name}}</span>
            </a>
            @endforeach

		</nav>
	<section id="Category-result" class="max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
		<h1 class="text-4xl leading-[45px] font-bold text-center">
			Explore Our <br />
			{{$category->name}} News
		</h1>
		<div id="search-cards" class="grid grid-cols-3 gap-[30px]">
            @forelse ($category->news as $news)
			<a href="{{route('front.details', $news->slug)}}" class="card">
				<div
					class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
					<div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
						<div
							class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
							<p class="text-xs leading-[18px] font-bold uppercase">{{$news->category->name}}</p>
						</div>
						<img src="{{Storage::url($news->thumbnail)}}" alt="thumbnail photo"
							class="w-full h-full object-cover" />
					</div>
					<div class="flex flex-col gap-[6px]">
						<h3 class="text-lg leading-[27px] font-bold">
                        {{substr($news->name,0,80)}}{{strlen(string: $news->name)>80?'...':''}}
                    </h3>
						<p class="text-sm leading-[21px] text-[#A3A6AE]">{{$news->created_at->format('M d,Y ')}}</p>
					</div>
				</div>
			</a>
            @empty
            <p class="text-center text-lg font-semibold">No news available in this category</p>
            @endforelse
		</div>
	</section>
	<section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
		<div class="flex flex-col gap-3 shrink-0 w-fit">
			<div class="flex flex-col gap-3 shrink-0 w-fit">
					@if ($bannerads)
						<a href="{{ $bannerads->link ?? '#' }}">
							<div class="w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
								<img src="{{ Storage::url($bannerads->thumbnail) }}" class="object-cover w-full h-full" alt="ads" />
							</div>
						</a>
					@else
						<div class="w-[900px] h-[120px] flex items-center justify-center border border-[#EEF0F7] rounded-2xl bg-gray-100 text-gray-500 text-lg">
							Iklan belum tersedia
						</div>
					@endif
				</div>
			</a>
			<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
				Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
						src="{{asset('assets/images/icons/message-question.svg')}}" alt="icon" /></a>
			</p>
		</div>
	</section>
</body>

@endsection
@push('after-scripts')
        <script src="https://cdn.tailwindcss.com"></script>
@endpush