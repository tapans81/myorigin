(function($){
	$(document).ready(function(){
		
		
		$.each(JSON.parse(mysdata),function(a,b){
			
			console.log(b);
				});
		

		var originalModal = $('#mymodal').clone();
			$('body').on('show.bs.modal','#mymodal',  function(e){
				var htm='';
				console.log($(e.relatedTarget));
				var button=$(e.relatedTarget);
				pid=button.attr('id');
				console.log(pid);
			$.each(JSON.parse(mysdata),function(a,b){
			if(b[0].pid==pid)
			{
				$.each(b,function(c,d){
					// console.log(d);
					// date=new Date(d.timestamp);

					htm+='<tr><td>'+d.timestamp+'</td></tr>';

				});
				console.log(htm);
				return false;
			}
			
			});
			$('#mymodal .modal-body table tbody').append(htm);
				});

		

		$('body').on('hidden.bs.modal', '#mymodal', function () {
			     $('#mymodal').remove();
			    var myClone = originalModal.clone();
			    $('body').append(myClone);

			});
	});
})(jQuery);