<div class="project-url">
@if(!empty($projectPartialKeywordData[0]))
   @foreach($projectPartialKeywordData as $projectPartialKeyword)
     <span class='badge badge-info mb-3'  style="font-size:14px;">{{ $projectPartialKeyword->partial_keywords }}</span><br>
	@endforeach
@else
	<p class="text-center">Partial Keyword Not Found</p>
@endif
</div>