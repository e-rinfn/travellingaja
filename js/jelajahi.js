function convertYoutube(url){

if(url.includes("youtu.be")){
let id = url.split("youtu.be/")[1];
return "https://www.youtube.com/embed/" + id.split("?")[0];
}

if(url.includes("watch?v=")){
let id = url.split("watch?v=")[1];
return "https://www.youtube.com/embed/" + id.split("&")[0];
}

return url;

}