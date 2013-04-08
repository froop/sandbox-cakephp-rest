$(function () {
	"use strict";
	var HTTP_BAD_REQUEST = 400;
	var HTTP_NOT_FOUND = 404;
	var id = $.url().param()["id"];

	if (id) {
		$.getJSON("../samples/" + id + ".json", function (data) {
			$("input[name=text1]").val(data.text1);
		});
	}

	$("#form1").on("submit", function () {
		var url = "../samples" + (id ? "/" + id : "");
		$.ajax(url, {
			type : "POST",
			data : $("#form1").serialize(),
			success : function (responseText) {
				$("#message").text(responseText);
			},
			error : function(xhr, textStatus, errorThrown) {
				if (xhr.status === HTTP_BAD_REQUEST) {
					$("#message").text(xhr.responseText);
				} else if (xhr.status === HTTP_NOT_FOUND) {
					$("#message").text("ID is not found");
				} else {
					alert(xhr.status + ":" + textStatus + ":" + errorThrown);
				}
			},
			complete : function () {
				$("#back").show();
			}
		});

		// デフォルト動作抑止
		return false;
	});

	$("#back").hide();
});
