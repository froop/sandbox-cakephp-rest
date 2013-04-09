$(function () {
	"use strict";
	var BASE_URL = "../api/samples";
	var HTTP_BAD_REQUEST = 400;
	var HTTP_NOT_FOUND = 404;
	var id = $.url().param()["id"];
	var $message = $("#message");

	function errorCallback(xhr, textStatus, errorThrown) {
		var text;
		if (xhr.status === HTTP_BAD_REQUEST) {
			text = xhr.responseText;
		} else if (xhr.status === HTTP_NOT_FOUND) {
			text = "ID is not found";
		} else {
			text = xhr.status + ":" + textStatus + ":" + errorThrown;
		}
		$message.text(text);
	}

	if (id) {
		$.ajax({
			url : BASE_URL + "/" + id + ".json",
			type : "GET",
			dataType : "json",
			error : errorCallback,
			success : function (data) {
				$("input[name=text1]").val(data.text1);
			},
		});
	}

	$("#form1").on("submit", function () {
		$.ajax(BASE_URL + (id ? "/" + id : ""), {
			type : "POST",
			data : $("#form1").serialize(),
			error : errorCallback,
			success : function (responseText) {
				$message.text(responseText);
			},
			complete : function () {
//				$("#back").show();
			}
		});

		// prevent default
		return false;
	});

//	$("#back").hide();
});
