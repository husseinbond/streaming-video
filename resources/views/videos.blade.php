
<!DOCTYPE html>
<html>
<head> 
<style>
    /* This is purely for the demo */
.container {
  max-width: 800px;
  margin: 0 auto;
}
.plyr {
  border-radius: 4px;
  margin-bottom: 15px;
}
ul {

}
.player-src{
  background-color: red;
  height: 20px;
  width: 120px;
  padding: 2px;
  margin: 2px;
}
</style>

<script src="https://cdn.plyr.io/3.5.10/plyr.js"></script>
<script src="https://cdn.plyr.io/3.5.10/plyr.polyfilled.js"></script>
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css" />
    </head>
    <body>

<div class="container">

@foreach($videos as $video)
<video controls crossorigin playsinline  id="player">
@foreach($video->vibs as $src)
                <source src="/storage/240/{{$src->path}}" type="video/mp4" size="{{$src->label}}">
           

@endforeach
                
            </video>
@endforeach



</body>
</html>
