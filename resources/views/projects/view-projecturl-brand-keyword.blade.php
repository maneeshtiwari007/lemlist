<div class="project-url">
@if(!empty($projectUrlBrandKeywordData[0]))
   @foreach($projectUrlBrandKeywordData as $projectUrlBrandKeyword)
     <span class='badge badge-info mb-3'  style="font-size:14px;">{{ $projectUrlBrandKeyword->brand_keyword }}</span><br>
	@endforeach
@else
	<p class="text-center">Brand Keyword Not Found</p>
@endif
</div>