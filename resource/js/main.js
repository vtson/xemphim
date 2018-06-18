$(function() {

	var i;
	var selectId = ['#multiple-job', '#multiple-country', '#multiple-genre', '.participant-actor', '#multiple-directors'];
	for (i = 0;i < selectId.length; i++){
		if($(selectId[i]).length){
			var x = initSlim(selectId[i]);
		}
	}

 	$('#newFieldActor').click(function(){
 		var $fieldActor = $('.field-actor:first').clone();
  		$('.field-actors').append($fieldActor);
  	});

  	$('.delete-field').on('click', function(){
    	$(this).closest(".field-actor").remove();
	});

  	var modal_report = document.getElementById("dialog");

	$(".report").click(function (e) {

        e.preventDefault();

        var object = $(this).attr("data-object"),
            episode_id,
            thisLike = $(this);
        if (object === 'report') {
            episode_id = thisLike.closest(".card").attr("data-episode-id");
        }

        $.ajax({
            method: 'POST',
            url: "http://xem-phims.com/report/create",
            data: {episode_id: episode_id},
            dataType: 'json',
            success: function (data) {
            	$('.modal-content').append(data);
            	modal_report.showModal();
			    $('.episode-show').phpReport();
            }
        });

    });

	function PhpReport(element) {
        this.element = element;
        this.init();
    }

    PhpReport.prototype.init = function () {
        this.setupVariables();
        this.setupEvents();
    }

    PhpReport.prototype.setupVariables = function () {
        this.reportForm = this.element.find(".report-form");
        this.contentField = this.element.find(".report-content");
        this.episodeField = this.element.find(".episode_id");
    }

    PhpReport.prototype.setupEvents = function () {
        var phpReport = this;

        phpReport.reportForm.on("submit", function (e) {
            e.preventDefault();

            var content = phpReport.contentField.val(),
                episode_id = phpReport.episodeField.val();

            $.ajax({
                url: phpReport.reportForm.attr("action"),
                method: 'POST',
                dataType: 'json',
                data: {content: content, episode_id: episode_id},
                success: function (data) {
                	$('.report-modal').remove();
	        		modal_report.close();
	        		$('.modal-content').append(data);
            		modal_report.showModal(); 
                }
            });
        });
    }

   	$.fn.phpReport = function (options) {
		new PhpReport(this);
		return this;
	}

    window.onclick = function(event) {
        if(!$(event.target).closest('.modal-content').length){
    	    if (event.target == modal_report) {
    	    	$('.report-modal').remove();
    	        modal_report.close();
    	    }
    	    $(".modal-content").html("");
                event.stopPropagation();
        }
	}

});

function initSlim(element){
	new SlimSelect({
  		select: element
  	})
}