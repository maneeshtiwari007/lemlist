<div class="project-url">
@if(!empty($projectUrlSecondaryKeywordData[0]))
   @foreach($projectUrlSecondaryKeywordData as $projectUrlSecondaryKeyword)
     <span class='badge badge-info mb-3'  style="font-size:14px;">{{ $projectUrlSecondaryKeyword->secondary_keyword }}</span><br>
	@endforeach
@else
	<p class="text-center">Secondary Keyword Not Found</p>
@endif
</div>