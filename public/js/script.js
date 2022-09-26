  const comment=document.querySelector("#comment");
  comment.addEventListener("click", (e) => e.preventDefault());

  $(document).on("click touchstart",".like", function(e){
    e.preventDefault();

    var _this=$(this);

    var _url="/like/"+_this.attr("data-type")+"/"+_this.attr("data-model-id");

    $.get(_url, function(data){ 
        if(data == "0"){
          alert("Gak boleh like diri sendiri");
        }else{
          if(_url.split("/")[2] === "2"){
            _this.addClass("text-danger unlike").removeClass("text-black like").html("Unlike");
          }else{
            _this.addClass("text-primary unlike").removeClass("text-black like");
            let likeNumber=$(".like_number");
            likeNumber.html(parseInt(likeNumber.html())+1);
          }
        }
    }); 
});


$(document).on("click touchstart",".unlike", function(e){
    e.preventDefault();

    var _this=$(this);

    var _url="/unlike/"+_this.attr("data-type")+"/"+_this.attr("data-model-id");

    $.get(_url, function(data){ 
        if(_url.split("/")[2] === "2"){
            _this.addClass("text-black like").removeClass("unlike").html("Like");
        }else{
            _this.addClass("text-black like").removeClass("unlike");
            let likeNumber=$(".like_number");
            console.log(likeNumber.html());
            likeNumber.html(parseInt(likeNumber.html())-1);
        }
    }); 
});