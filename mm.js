$(document).ready(function(){
	//var url = 'http://localhost/manoj/web%20crawler/_form.php';
	//var formData = {
		//'keyword':'send flower to pune'
	$.ajax({
			type     : 'POST',
			url		 : 'http://www.seocentro.com/tools/search-engines/keyword-position.html',
			data     : {

						q:'send flower to pune',
						d:'www.flaberry.com',
						d2:'www.flaberry.com',
						dkey:'77fc6351e915099712b068a70588bada',
						rkey:'7908',
					  	Submit:'submit'
					},
		success:function(data)
		{
			//console.log(data);
			//alert(data);
			$("#result").html(data);
		}

});
});