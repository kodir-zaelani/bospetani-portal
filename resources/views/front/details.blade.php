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
	<header class = "flex flex-col items-center gap-[50px] mt-[70px]">
	<div    id    = "Headline" class              = "max-w-[1130px] mx-auto flex flex-col gap-4 items-center">
	<p      class = "w-fit text-[#A3A6AE]">{{$details_article_news->created_at->format('M d, Y')}} • {{$details_article_news->category->name}}</p>
	<h1     id    = "Title" class                 = "font-bold text-[46px] leading-[60px] text-center two-lines">{{$details_article_news->title}}</h1>
			<div class = "flex items-center justify-center gap-[70px]">
			<a   id    = "Author" href                           = "{{route('front.author', $details_article_news->author->slug)}}" class              = "w-fit h-fit">
			<div class = "flex items-center gap-3">
			<div class = "w-10 h-10 rounded-full overflow-hidden">
			<img src   = "{{asset('')}}uploads/{{$details_article_news->author->avatar}}"" class = "object-cover w-full h-full" alt = "avatar">
						</div>
						<div class = "flex flex-col">
						<p   class = "font-semibold text-sm leading-[21px]">{{$details_article_news->author->name}}</p>
						<p   class = "text-xs leading-[18px] text-[#A3A6AE]">{{$details_article_news->author->occupation}}</p>
						</div>
					</div>
				</a>
				<div id    = "Rating" class                       = "flex items-center gap-1">
				<div class = "flex items-center">
				<div class = "w-4 h-4 flex shrink-0">
				<img src   = "{{asset('')}}front/assets/images/icons/Star 1.svg" alt = "star">
						</div>
						<div class = "w-4 h-4 flex shrink-0">
						<img src   = "{{asset('')}}front/assets/images/icons/Star 1.svg" alt = "star">
						</div>
						<div class = "w-4 h-4 flex shrink-0">
						<img src   = "{{asset('')}}front/assets/images/icons/Star 1.svg" alt = "star">
						</div>
						<div class = "w-4 h-4 flex shrink-0">
						<img src   = "{{asset('')}}front/assets/images/icons/Star 1.svg" alt = "star">
						</div>
						<div class = "w-4 h-4 flex shrink-0">
						<img src   = "{{asset('')}}front/assets/images/icons/Star 1.svg" alt = "star">
						</div>
					</div>
					<p class = "font-semibold text-xs leading-[18px]">(12,490)</p>
				</div>
			</div>
		</div>
		<div class = "w-full h-[500px] flex shrink-0 overflow-hidden">
		<img src   = "{{asset('')}}uploads/{{$details_article_news->thumbnail}}" class = "object-cover w-full h-full" alt = "cover thumbnail">
		</div>
	</header>
	<section id="Article-container" class="max-w-[1130px] mx-auto flex gap-20 mt-[50px]">
		<article id="Content-wrapper">
			{!!$details_article_news->content!!}
		</article>
		<div class = "side-bar flex flex-col w-[300px] shrink-0 gap-10">
             @if (!empty($square_bannerads_1))
			<div class="ads flex flex-col gap-3 w-full">
				<a   href = "{{$square_bannerads_1->link}}">
				<img src  = "{{asset('')}}uploads/{{$square_bannerads_1->thumbnail}}" class = "object-contain w-full h-full" alt = "ads" />
				</a>
				<p  class                 = "font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
				Our Advertisement <a href = "#" class = "w-[18px] h-[18px]"><img
							src="{{asset('')}}front/assets/images/icons/message-question.svg" alt="icon" /></a>
				</p>
			</div>
            @endif
            @if ($author_articlenews->count() > 0)
			<div id="More-from-author" class="flex flex-col gap-4">
				<p class="font-bold">More From Author</p>

                @forelse ($author_articlenews as $item)
				<a href="{{route('front.details', $item->slug)}}" class="card-from-author">
					<div
						class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
						<div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden rounded-2xl">
							<img src="{{asset('')}}uploads/{{$item->thumbnail}}" class="object-cover w-full h-full"
								alt="thumbnail">
						</div>
						<div class="flex flex-col gap-[6px]">
							<p class="line-clamp-2 font-bold">{{substr($item->title, 0, 50)}} {{strlen($item->title) > 50 ? '...' : ''}}</p>
							<p class="text-xs leading-[18px] text-[#A3A6AE]">{{$item->created_at->format('M d, Y')}} • {{$item->category->name}}</p>
						</div>
					</div>
				</a>

                @empty
                    <p>Belum ada update terbaru</p>
                @endforelse
			</div>
            @endif
            @if (!empty($square_bannerads_2))
			<div class="ads flex flex-col gap-3 w-full">
				<a href="{{$square_bannerads_2->link}}">
					<img src="{{asset('')}}uploads/{{$square_bannerads_2->thumbnail}}" class="object-contain w-full h-full" alt="ads" />
				</a>
				<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
					Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
							src="{{asset('')}}front/assets/images/icons/message-question.svg" alt="icon" /></a>
				</p>
			</div>
            @endif
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
	<section id="Up-to-date" class="w-full flex justify-center mt-[70px] py-[50px] bg-[#F9F9FC]">
		<div class="max-w-[1130px] mx-auto flex flex-col gap-[30px]">
			<div class="flex justify-between items-center">
				<h2 class="font-bold text-[26px] leading-[39px]">
					Other News You <br />
					Might Be Interested
				</h2>
			</div>
			<div class="grid grid-cols-3 gap-[30px]">
                @forelse ($articlenews as $item)
				<a href="{{route('front.details', $item->slug)}}" class="card-news">
					<div
						class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[26px_20px] flex flex-col gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300 bg-white">
						<div
							class="thumbnail-container w-full h-[200px] rounded-[20px] flex shrink-0 overflow-hidden relative">
							<p
								class="badge-white absolute top-5 left-5 rounded-full p-[8px_18px] bg-white font-bold text-xs leading-[18px] uppercase">
								{{$item->category->name}}</p>
							<img src="{{asset('')}}uploads/{{$item->thumbnail}}" class="object-cover w-full h-full"
								alt="thumbnail" />
						</div>
						<div class="card-info flex flex-col gap-[6px]">
							<h3 class="font-bold text-lg leading-[27px]">{{substr($item->title, 0, 50)}} {{strlen($item->title) > 50 ? '...' : ''}}</h3>
							<p class="text-sm leading-[21px] text-[#A3A6AE]">{{$item->created_at->format('M d, Y')}}</p>
						</div>
					</div>
				</a>
                @empty
                    <p>Belum ada data terbaru</p>
                @endforelse
			</div>
		</div>
	</section>

</body>
@endsection
@push('after-styles')
<!-- CSS -->
<link rel  = "preconnect" href= "https://fonts.googleapis.com">
<link rel  = "preconnect" href= "https://fonts.gstatic.com" crossorigin>
<link href = "https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel = "stylesheet">
<link href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
      rel  = "stylesheet" />
<link rel  = "stylesheet" href= "https://unpkg.com/flickity@2/dist/flickity.min.css" />
@endpush
@push('after-scripts')
<!-- JavaScript -->
<script src = "{{asset('')}}front/js/two-lines-text.js"></script>
<script src = "https://cdn.tailwindcss.com"></script>
@endpush
