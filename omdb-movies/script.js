// search function
function searchMovie() {
  $("#movie-list").html("");
  $.ajax({
    url: "http://www.omdbapi.com",
    type: "get",
    dataType: "json",
    data: {
      apiKey: "8add069",
      s: $("#search-inputs").val(),
    },
    success: function (result) {
      if (result.Response == "True") {
        let movies = result.Search;
        $.each(movies, function (i, data) {
          $("#movie-list").append(`
            <div class="col-md-4">
              <div class="card">
                  <img src="${data.Poster}" class="card-img-top">
                  <div class="card-body">
                      <h5 class="card-title">${data.Title}</h5>
                      <p class="card-text">${data.Year}</p>
                      <a href="#" class="card-link see-detail" data-bs-toggle="modal"
                      data-bs-target="#exampleModal" data-id="${data.imdbID}">See Detail</a>
                  </div>
              </div>
            </div>
            `);
        });
        $("#search-inputs").val("");
      } else {
        $("#movie-list").html(`
              <h1 class='text-center'>
                  ${result.Error}
              </h1>
          `);
      }
    },
  });
}

// search
$("#search-btn").on("click", function () {
  searchMovie();
});

// detail
$("#movie-list").on("click", ".see-detail", function () {
  $.ajax({
    url: "http://www.omdbapi.com",
    type: "get",
    dataType: "json",
    data: {
      apiKey: "8add069",
      i: $(this).data("id"),
    },
    success: function (single_result) {
      if (single_result.Response === "True") {
        $(".modal-body").html(`
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <img src="${single_result.Poster}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <ul clas="list-group">
                        <li class="list-group-item">${single_result.Title}</li>
                        <li class="list-group-item">${single_result.Released}</li>
                        <li class="list-group-item">${single_result.Year}</li>
                        <li class="list-group-item">${single_result.Genre}</li>
                        <li class="list-group-item">${single_result.Director}</li>
                        <li class="list-group-item">${single_result.Actors}</li>
                    </ul>
                </div>
            </div>
        </div>
        `);
      }
    },
  });
});
