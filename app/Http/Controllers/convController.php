<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Video;
use FFMpeg;
use App\Jobs\ConvertVideoForStreaming;
use App\vibs;
use Carbon\Carbon;
use App\attr;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
class convController extends Controller
{
    

    public function index()
    {
        $videos = Video::with('vibs')->get();
        return view('videos')->with('videos', $videos);
    }


    public function store(Request $request)
    {


            $video = Video::create([
                'disk'          => 'public',
                'original_name' => $request->image->getClientOriginalName(),
                'path'          => $request->file('image')->storeAs('public',$request->image->getClientOriginalName()),
             
            ]);
    

      
     // create some video formats...
     $lowBitrateFormat  = (new X264)->setKiloBitrate(500);
         
            
         
     FFMpeg::fromDisk($video->disk)
              ->open($video->original_name)
  
              ->addFilter(function ($filters) {
                $filters->resize(new Dimension(960, 540));
            })

            ->export()

               ->toDisk('public')
            ->inFormat($lowBitrateFormat)
              
              ->save('240/'.$video->id.'.mp4');


              vibs::create([
                  'disk'          => 'public',
                  'label' => '240',
                  'path'          => '240/'.$video->id.'.mp4',
                  'video_id' => $video->id
              ]);
  



  
  



      $video->update([
           'converted_for_streaming_at' => Carbon::now(),
       ]);



        // dispatch( new ConvertVideoForStreaming($video))->delay(\carbon\carbon::now()->addseconds(5));
        
        return response()->json([
            'id' => $video->id,
        ], 201);
        
     
        }

}
