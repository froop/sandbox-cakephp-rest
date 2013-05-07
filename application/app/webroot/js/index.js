/*global $ */

$(function () {
	"use strict";

	$.ajax({
		url : "../api/samples",
		type : "GET",
		dataType : "json",
		beforeSend : function (xhr) {
//			xhr.setRequestHeader("If-Modified-Since",
//					"Thu, 01 Jun 1970 00:00:00 GMT");
		},
		success : function (data) {
			$("#id1").text(data.key1);

			$.each(data.list, function () {
				var $link = $("<a>")
						.attr("href", "input.html?" + $.param({ id : this.Sample.id }))
						.text(this.Sample.modified + ":" + this.Sample.text1);
				$("#list1").append($("<li>").append($link));
			});
		}
	});
});
