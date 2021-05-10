<div class="row">
 <div class="col-md-6">
 <strong>Job Title</strong>
 <p>{{ $getJob->job_title }}</p>
 </div>
 <div class="col-md-6">
 <strong>Job Status</strong>
 <p>{{ !empty($getJobReport->status) ? $getJobReport->status : '-' }}</p>
 </div>
</div>
<div class="row">
 <div class="col-md-6">
 <strong>Processing Count</strong>
 <p>{{ !empty($getJobReport->processing_count) ? $getJobReport->processing_count : 0 }}</p>
 </div>
 <div class="col-md-6">
 <strong>Completed Count</strong>
 <p>{{ !empty($getJobReport->completed_count) ? $getJobReport->completed_count : 0 }}</p>
 </div>
</div>
<div class="row">
 <div class="col-md-6">
 <strong>Failed Count</strong>
 <p>{{ !empty($getJobReport->failed_count) ? $getJobReport->failed_count : 0 }}</p>
 </div>
 <div class="col-md-6">
 <strong>Aborted Count</strong>
 <p>{{ !empty($getJobReport->aborted_count) ? $getJobReport->aborted_count : 0 }}</p>
 </div>
</div>
<div class="row">
 <div class="col-md-6">
 <strong>Ignored Count</strong>
 <p>{{ !empty($getJobReport->ignored_count) ? $getJobReport->ignored_count : 0 }}</p>
 </div>
 <div class="col-md-6">
 <strong>Scheduled Count</strong>
 <p>{{ !empty($getJobReport->scheduled_count) ? $getJobReport->scheduled_count : 0 }}</p>
 </div>
</div>