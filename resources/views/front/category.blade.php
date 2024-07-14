@extends('front.master')
@section('content')

<body class = "font-[Poppins] pb-[83px]">
	<x-navbar />
	<nav id = "Category" class = "max-w-[1130px] mx-auto flex justify-center items-center gap-4 mt-[30px]">
            @forelse ($categories as $item)
				<a   href  = "{{route('front.category', $item->slug)}}" class = "rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
				<div class = "w-6 h-6 flex shrink-0">
				<img src   = "{{asset('')}}uploads/{{$item->icon}}" alt       = "icon" />
				</div>
				<span>{{$item->name}}</span>
			</a>
            @empty
                <p>Belum ada category</p>
            @endforelse
		</nav>
	<section id    = "Category-result" class = "max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
	<h1      class = "text-4xl leading-[45px] font-bold text-center">
			Explore Our <br />
			{{$category->name}} News
		</h1>
		<div id   = "search-cards" class = "grid grid-cols-3 gap-[30px]">
                @forelse ($category->articles as $item)
		<a   href = "{{route('front.details', $item->slug)}}" class = "card">
				<div
					     class = "flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
					<div class = "thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
						<div
							   class = "badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
							<p class = "text-xs leading-[18px] font-bold uppercase">{{$item->category->name}}</p>
						</div>
						<img src="{{asset('')}}uploads/{{$item->thumbnail}}" alt = "thumbnail photo"
						     class = "w-full h-full object-cover" />
					</div>
					<div class = "flex flex-col gap-[6px]">
					<h3  class = "text-lg leading-[27px] font-bold">{{substr($item->title, 0, 50)}} {{strlen($item->title) > 50 ? '...' : ''}}</h3>
						<p class = "text-sm leading-[21px] text-[#A3A6AE]">{{$item->created_at->format('M d, Y')}}</p>
					</div>
				</div>
			</a>

                @empty
                    <p>Belum ada data terbaru</p>
                @endforelse
		</div>
	</section>
	<section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
		<div class="flex flex-col gap-3 shrink-0 w-fit">
			<a   href  = "{{$bannerads->link}}" target                          = "_blank">
			<div class = "w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
			<img src   = "{{asset('')}}uploads/{{$bannerads->thumbnail}}" class = "object-cover w-full h-full" alt = "ads" />
					</div>
				</a>
			<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
				Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
						src="{{asset('')}}front/assets/images/icons/message-question.svg" alt="icon" /></a>
			</p>
		</div>
	</section>
</body>
@endsection
@push('after-scripts')
<!-- JavaScript -->
<script src = "https://cdn.tailwindcss.com"></script>
@endpush