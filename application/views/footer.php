
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<a href="https://itssindia.in/" target="_blank"><span class="blue bolder">I Tech Software Solution</span></a>
							Application &copy; 2014-<?=date('Y')?>
						</span>

						&nbsp; &nbsp;
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>



<style>
	.btn-primary{
        	background-color: #009900;
        }
</style>

<script>
    function SuccessAlert()
    {                
        toastr.options.timeOut = 2000; // 3s
        toastr.options.positionClass =  "toast-top-center"; 
        toastr.options.hideDuration = 1000; 
        toastr.options.showDuration = 400; 
        toastr.options.closeButton = true;
        toastr.options.progressBar = true; 
        toastr.options.showEasing = "swing";
        toastr.options.hideEasing = "linear"; 
        toastr.options.showMethod = "fadeIn";
        toastr.options.hideMethod = "fadeOut";
        toastr.success('Record Saved Successfully')
    }

    function SuccessAlert1($msg)
    {                
        toastr.options.timeOut = 2000; // 3s
        toastr.options.positionClass =  "toast-top-center"; 
        toastr.options.hideDuration = 1000; 
        toastr.options.showDuration = 400; 
        toastr.options.closeButton = true;
        toastr.options.progressBar = true; 
        toastr.options.showEasing = "swing";
        toastr.options.hideEasing = "linear"; 
        toastr.options.showMethod = "fadeIn";
        toastr.options.hideMethod = "fadeOut";
        toastr.success($msg)
    }

    function ErrorAlert(msg)
    {                
        toastr.options.timeOut = 2000; // 3s
        toastr.options.positionClass =  "toast-top-center"; 
        toastr.options.hideDuration = 1000; 
        toastr.options.showDuration = 400; 
        toastr.options.closeButton = true;
        toastr.options.progressBar = true; 
        toastr.options.showEasing = "swing";
        toastr.options.hideEasing = "linear"; 
        toastr.options.showMethod = "fadeIn";
        toastr.options.hideMethod = "fadeOut";
        toastr.error(msg)
    }

    function DeleteAlert()
    {                
        toastr.options.timeOut = 2000; // 3s
        toastr.options.positionClass =  "toast-top-center"; 
        toastr.options.hideDuration = 1000; 
        toastr.options.showDuration = 400; 
        toastr.options.closeButton = true;
        toastr.options.progressBar = true; 
        toastr.options.showEasing = "swing";
        toastr.options.hideEasing = "linear"; 
        toastr.options.showMethod = "fadeIn";
        toastr.options.hideMethod = "fadeOut";
        toastr.success('Record Deleted')
    }
    function CancelAlert()
    {                
        toastr.options.timeOut = 2000; // 3s
        toastr.options.positionClass =  "toast-top-center"; 
        toastr.options.hideDuration = 1000; 
        toastr.options.showDuration = 400; 
        toastr.options.closeButton = true;
        toastr.options.progressBar = true; 
        toastr.options.showEasing = "swing";
        toastr.options.hideEasing = "linear"; 
        toastr.options.showMethod = "fadeIn";
        toastr.options.hideMethod = "fadeOut";
        toastr.success('Record Canceled')
    }

    function notify(v1,v2)
    {                
        toastr.options.timeOut = 90000; // 3s
        toastr.options.positionClass =  "toast-top-right",
        toastr.options.hideDuration = 1000; 
        toastr.options.showDuration = 400; 
        toastr.options.closeButton = true;
        toastr.options.progressBar = true; 
        toastr.options.showEasing = "swing";
        toastr.options.hideEasing = "linear"; 
        toastr.options.showMethod = "fadeIn";
        toastr.options.hideMethod = "fadeOut";
        toastr.info(v1,v2)
    }
</script>