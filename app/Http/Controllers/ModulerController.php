<?php

namespace App\Http\Controllers;

use App\Models\Moduler;
use Illuminate\Support\Str;
use  App\Models\Kategoriler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\File;
// use File;

class ModulerController extends Controller

{
    function __construct()
    {
        return view()->share('moduler', Moduler::whereDurum(1)->get());
    }

    public function index()
    {
        return view('admin.include.moduler');
    }
    public function modulekle(Request $request)
    {
        $request->validate([
            'baslik' => 'required|string',

        ]);
        $baslik = $request->baslik;
        $seflink = Str::of($baslik)->slug('');
        $kontrol = moduler::whereSeflink($seflink)->first();
        if ($kontrol) {
            return redirect()->route('moduler')->with('hata', 'Bu modül daha önce eklenmiştir');
        } else {
            // 1 modul olusturma
            moduler::create([
                'baslik' => $baslik,
                'seflink' => $seflink
            ]);
            // 2 ci adım Kategori kayıt işlemi
            Kategoriler::create([
                'baslik' => $baslik,
                'seflink' => $seflink,
                'tablo' => 'modul',
                'sirano' => 1
            ]);
            // 3 cu adım dınamık tablo olusturma işlemi
            Schema::create($seflink, function (Blueprint $table) {
                $table->id();
                $table->string('baslik', 255);
                $table->string('seflink', 255);
                $table->string('resim', 255)->nullable();
                $table->longText('metin')->nullable();
                $table->unsignedBigInteger('kategori')->nullable();
                $table->string('anahtar', 255)->nullable();
                $table->string('description', 255)->nullable();
                $table->enum('durum', [1, 2])->default(1);      /*1 aktıf 2 pasıf*/
                $table->integer('sirano')->nullable();
                $table->timestamps();
                $table->foreign('kategori')->references('id')->on('kategoriler')->onDelete('cascade');
            });
            // 4.cu adım model olusturma

            $modelDosyasi = '<?php
                 namespace App\Models;
                 use Illuminate\Database\Eloquent\Factories\HasFactory;
                 use Illuminate\Database\Eloquent\Model;
                 class ' . ucfirst($seflink) . ' extends Model
                 {
                 use HasFactory;
                 protected $table = "' . $seflink . '";
                 protected $fillable = ["id","baslik","seflink","kategori","resim","metin","anahtar","description","durum","sirano","created_at","updated_at"];
                 }';
            File::put(app_path('Models') . "/" . ucfirst($seflink) . '.php', $modelDosyasi);/*hizmetler.php */
            return redirect()->route('moduler')->with('basarili', 'İşleminiz başarıyla kaydedildi');
        }
    }
}
