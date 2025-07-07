// Домашнее задание по теме "REST"
// https://github.com/netology-code/bweb-homeworks/tree/main/4.%20REST

$(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      query: $("#ip").val(),
    };
	var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip=";
	var token = "5c970ec3cd8793e7ce6f7ceb704c1e4eea4b26da";

    $.ajax({
      type: "GET",
      url: url + formData.query,
	  beforeSend: function(xhr) {
                 xhr.setRequestHeader("Authorization", "Token "+ token) 
            },
      data: '',
      dataType: "json",
      encode: true,
    }).done(function (result) {
      console.log(result);
      $('#result').text(result.location.value);
	});

    event.preventDefault();
  });
});
