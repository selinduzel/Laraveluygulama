<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Moduler;
use App\Models\Kategoriler;

class AdminYonetim extends Controller 
{
    function __construct()
    {
        return view()->share('moduler', Moduler::whereDurum(1)->get());
    }
    public function home()
    {
        return view('admin.include.home');
    }
    
    public function liste($modul)
    {
      $kontrol=Moduler::whereDurum(1)->whereSeflink($modul)->first();
      if($kontrol)
      {
        return view("admin.include.liste");
      }
      else 
      {
        return redirect()->route('home');
      }
   
    }

    public function ekle($modul)
    {
      $modulBilgisi=Moduler::whereDurum(1)->whereSeflink($modul)->first();
      $kategoriBilgisi= Kategoriler:: whereTablo('modul')->whereSeflink($modul)->get();
      if($modulBilgisi && $kategoriBilgisi)
      {
        return view("admin.include.ekle",compact(['modulBilgisi','kategoriBilgisi']));
      }
      else 
      {
        return redirect()->route('home');
      }
   
    }

    public function eklePost($modul,Request $request)
      {
        $modulBilgisi=Moduler::whereDurum(1)->whereSeflink($modul)->first();
        if($modulBilgisi)
        {
          $modelDosyaAdi=ucfirst($modulBilgisi->seflink);//Kurumsal
          $request->validate([
            'baslik' => 'required|string',
            'kategori' => 'required',
            'anahtar' => 'required',
            'description' => 'required',
        ]);

        $baslik = $request->baslik;
        $seflink = Str::of($baslik)->slug('');
        $metin = $request->metin;
        $kategori = $request->kategori;
        $anahtar = $request->anahtar;
        $description = $request->description;
        $sirano = $request->sirano;
        $dinamikModel="App\Models\\".$modelDosyaAdi;
        $resimDosyasi=$request->file('resim');
        if(isset($resimDosyasi))
        {
           $resim=uniqid().".".$resimDosyasi->getClientOriginalExtension();
           $resimDosyasi->move(public_path("images/".$modulBilgisi->seflink),$resim);
           $kaydet=$dinamikModel::create([
            "baslik"=>$baslik,
            "seflink"=>$seflink,
            "metin"=>$metin,
            "kategori"=>$kategori,
            "resim"=>$resim,
            "anahtar"=>$anahtar,
            "description"=>$description,
            "sirano" =>$sirano
          ]);

        }
        else
        {
          $kaydet=$dinamikModel::create([
            "baslik"=>$baslik,
            "seflink"=>$seflink,
            "metin"=>$metin,
            "kategori"=>$kategori,
            "anahtar"=>$anahtar,
            "description"=>$description,
            "sirano" =>$sirano
          ]);
        }
        return redirect()->route('ekle',$modulBilgisi->seflink)->with('basarili','İşleminiz başarıyla kaydedildi');
        }
        else
        {
          return redirect()->route('home');
        }
      }
    

}
