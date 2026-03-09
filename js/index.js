(function(){
  var flag='loader_seen_once';
  var sels=['#loading-screen','.bg-noise','.progress-wrap','.rts-cursor.cursor-outer','.rts-cursor.cursor-inner'];
  if(localStorage.getItem(flag)==='1'){
    document.addEventListener('DOMContentLoaded',function(){sels.forEach(function(sel){var el=document.querySelector(sel);if(el)el.remove();});});
  }else{
    window.addEventListener('load',function(){
      localStorage.setItem(flag,'1');
      sels.forEach(function(sel){var el=document.querySelector(sel);if(el)el.style.display='none';});
    });
  }
})();

window.addEventListener("load",function(){
  if(window.gsap&&window.ScrollTrigger){
    gsap.registerPlugin(ScrollTrigger);
    var hasDegrade=document.querySelector(".degrade");
    var hasNext=document.querySelector(".next-section");
    if(hasDegrade&&hasNext){
      gsap.to(".video-bg",{filter:"blur(12px) brightness(0.2)",scale:1.05,opacity:0,scrollTrigger:{trigger:".degrade",start:"top top",endTrigger:".next-section",end:"top top",scrub:true,pin:true,pinSpacing:false}});
      gsap.to(".black-overlay",{opacity:1,scrollTrigger:{trigger:".degrade",endTrigger:".next-section",start:"top top",end:"top top",scrub:true}});
    }else if(hasDegrade){
      gsap.to(".video-bg",{filter:"blur(12px) brightness(0.2)",scale:1.05,opacity:0,scrollTrigger:{trigger:".degrade",start:"top top",end:"+=120%",scrub:true,pin:false,pinSpacing:true}});
      gsap.to(".black-overlay",{opacity:1,scrollTrigger:{trigger:".degrade",start:"top top",end:"+=120%",scrub:true}});
    }
  }
});

document.addEventListener("DOMContentLoaded",function(){
  const cards=document.querySelectorAll('.card-servicios');
  let lastTime=0;
  const MIN_INTERVAL=450;
  const imageOrderState={idxByKey:{},defaultList:Array.isArray(window.CARDS_IMAGES&&window.CARDS_IMAGES._default)?window.CARDS_IMAGES._default:[]};
  let lastSpot=null;
  const activePieces=new WeakMap();
  cards.forEach(function(card){
    card.addEventListener('mousemove',function(){
      const now=Date.now();
      if(now-lastTime>MIN_INTERVAL){
        const category=card.dataset.category||'';
        createTrailPieceForCard(category,card);
        lastTime=now;
      }
    });
    card.addEventListener('mouseleave',function(){
      const set=activePieces.get(card);
      if(set&&set.size){
        for(const piece of set){
          if(piece.__timeout)clearTimeout(piece.__timeout);
          if(piece.isConnected){
            if(window.gsap){gsap.to(piece,{opacity:0,duration:0.3,onComplete:function(){piece.remove();const s=activePieces.get(card);if(s)s.delete(piece);}});}
            else{piece.remove();const s=activePieces.get(card);if(s)s.delete(piece);}
          }
        }
        set.clear();
      }
    });
  });
  function normalizeCategory(cat){
    const c=String(cat||'').toLowerCase().trim();
    if(c==='publi')return'publicidad';
    if(c==='comu')return'comunicacion';
    if(c==='marca')return'marca';
    if(c==='publicidad'||c==='comunicacion'||c==='marca')return c;
    return'';
  }
  function nextSequentialImage(category){
    const normalized=normalizeCategory(category);
    let list=null;
    let key="__default__";
    if(normalized&&window.CARDS_IMAGES&&Array.isArray(window.CARDS_IMAGES[normalized])&&window.CARDS_IMAGES[normalized].length>0){
      list=window.CARDS_IMAGES[normalized];
      key="cat:"+normalized;
    }else if(window.CARDS_IMAGES&&Array.isArray(window.CARDS_IMAGES._default)&&window.CARDS_IMAGES._default.length>0){
      list=window.CARDS_IMAGES._default;
      key="__default__";
    }
    if(!list||list.length===0)return'';
    if(typeof imageOrderState.idxByKey[key]!=='number')imageOrderState.idxByKey[key]=0;
    const i=imageOrderState.idxByKey[key]%list.length;
    const url=list[i];
    imageOrderState.idxByKey[key]=(i+1)%list.length;
    return url;
  }
  function pickPositionAvoidingOverlap(vw,vh,w,h,pad){
    const baseMin=Math.max(140,Math.min(vw,vh)*0.12);
    const minDist=baseMin;
    let best=null;
    let bestScore=-1;
    for(let t=0;t<12;t++){
      const x=Math.floor(pad+Math.random()*Math.max(1,vw-pad*2-w));
      const y=Math.floor(pad+Math.random()*Math.max(1,vh-pad*2-h));
      if(!lastSpot)return{x,y};
      const cx=x+w/2;
      const cy=y+h/2;
      const dx=cx-lastSpot.x;
      const dy=cy-lastSpot.y;
      const dist=Math.hypot(dx,dy);
      const score=dist;
      if(dist>=minDist)return{x,y};
      if(score>bestScore){bestScore=score;best={x,y};}
    }
    return best||{x:pad,y:pad};
  }
  function createTrailPieceForCard(category,card){
    const url=nextSequentialImage(category);
    if(!url)return;
    const piece=new Image();
    piece.className='trail-piece';
    piece.style.position='fixed';
    piece.style.pointerEvents='none';
    piece.style.opacity='0';
    piece.style.visibility='hidden';
    piece.style.transform='none';
    piece.src=url;
    piece.decoding='async';
    piece.loading='eager';
    const PAD=16;
    const vw=window.innerWidth;
    const vh=window.innerHeight;
    const viewportLimit=Math.floor(Math.min(vw,vh)*0.6);
    const BASE_MAX=560;
    const MAX=Math.min(BASE_MAX,viewportLimit);
    let set=activePieces.get(card);
    if(!set){set=new Set();activePieces.set(card,set);}
    set.add(piece);
    document.body.appendChild(piece);
    piece.addEventListener('load',function(){
      const w=piece.naturalWidth||MAX;
      const h=piece.naturalHeight||MAX;
      const ratio=Math.min(MAX/w,MAX/h,1);
      const sizeBoost=(window.gsap?gsap.utils.random(1.35,1.6):1.45)*0.8;
      const finalW=Math.round(w*ratio*sizeBoost);
      const finalH=Math.round(h*ratio*sizeBoost);
      piece.style.width=finalW+'px';
      piece.style.height=finalH+'px';
      const pos=pickPositionAvoidingOverlap(vw,vh,finalW,finalH,PAD);
      piece.style.left=pos.x+'px';
      piece.style.top=pos.y+'px';
      const cx=pos.x+finalW/2;
      const cy=pos.y+finalH/2;
      lastSpot={x:cx,y:cy};
      piece.style.visibility='visible';
      if(window.gsap){gsap.fromTo(piece,{opacity:0,scale:0.88},{opacity:1,scale:1,duration:0.9,ease:"power3.out"});}else{piece.style.opacity='1';}
      piece.__timeout=setTimeout(function(){
        if(window.gsap){gsap.to(piece,{opacity:0,duration:0.3,onComplete:function(){piece.remove();const s=activePieces.get(card);if(s)s.delete(piece);}});}
        else{piece.remove();const s=activePieces.get(card);if(s)s.delete(piece);}
      },2000);
    });
  }
});

document.addEventListener('DOMContentLoaded',function(){
  const clasesIn={'magic-image':['animate__animated','animate__zoomIn'],'magic-image2':['animate__animated','animate__rotateIn'],'magic-image3':['animate__animated','animate__bounceIn']};
  const clasesOut={'magic-image':['animate__animated','animate__zoomOut'],'magic-image2':['animate__animated','animate__rotateOut'],'magic-image3':['animate__animated','animate__bounceOut']};
  const inView=new Set();
  const animating=new WeakMap();
  let lastScrollY=window.pageYOffset;
  let scrollDir='down';
  function animateIn(el,key){
    animating.set(el,true);
    el.classList.remove(...clasesOut[key]);
    el.classList.add(...clasesIn[key]);
    el.addEventListener('animationend',function handler(){animating.set(el,false);el.removeEventListener('animationend',handler);});
  }
  function animateOut(el,key){
    animating.set(el,true);
    el.classList.remove(...clasesIn[key]);
    el.classList.add(...clasesOut[key]);
    el.addEventListener('animationend',function handler(){animating.set(el,false);el.removeEventListener('animationend',handler);});
  }
  window.addEventListener('scroll',function(){
    const currentY=window.pageYOffset;
    scrollDir=currentY>lastScrollY?'down':'up';
    lastScrollY=currentY;
    inView.forEach(function(el){
      if(animating.get(el))return;
      const key=Array.from(el.classList).find(function(c){return clasesIn[c];});
      if(!key)return;
      const inClass=clasesIn[key][1];
      const outClass=clasesOut[key][1];
      if(scrollDir==='down'&&!el.classList.contains(inClass))animateIn(el,key);
      else if(scrollDir==='up'&&!el.classList.contains(outClass))animateOut(el,key);
    });
  });
  const observer=new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.intersectionRatio>=0.1)inView.add(entry.target);
      else inView.delete(entry.target);
    });
  },{threshold:[0.1]});
  document.querySelectorAll('.magic-image, .magic-image2, .magic-image3').forEach(function(el){
    animating.set(el,false);
    observer.observe(el);
  });
});

if(window.gsap&&window.ScrollTrigger)gsap.registerPlugin(ScrollTrigger);

function initFooterScroll(){
  const isMobile = window.matchMedia("(max-width: 991px)").matches;
  const mainElement=document.querySelector("#main");
  const footerElement=document.querySelector("footer.footer") || document.querySelector("footer");
  if(!footerElement) return;

  if(isMobile){
    footerElement.classList.add("relative-mob");
    footerElement.style.setProperty("opacity","1","important");
    footerElement.style.setProperty("visibility","visible","important");
    footerElement.style.setProperty("pointer-events","auto","important");
    if(mainElement){
      mainElement.style.transform="none";
      mainElement.style.marginBottom="0";
    }
    return;
  }

  if(!mainElement) return;

  let footerHeight=footerElement.offsetHeight;
  const lastSection=mainElement.querySelector("section:last-of-type");
  if(!lastSection) return;

  let lastSectionBottom=lastSection.getBoundingClientRect().bottom;
  let viewportHeight=window.innerHeight;
  let adjustment=Math.max(0,viewportHeight-lastSectionBottom);

  if(window.gsap&&window.ScrollTrigger){
    gsap.to(mainElement,{y:-(footerHeight+adjustment),ease:"none",scrollTrigger:{trigger:mainElement,start:"bottom bottom",end:"bottom top",scrub:true}});
  }

  document.body.style.overflowX='hidden';
}


console.clear();
if(window.gsap&&window.ScrollTrigger)gsap.registerPlugin(ScrollTrigger);

const cardsWrappers=window.gsap?gsap.utils.toArray(".card-wrapper"):Array.from(document.querySelectorAll(".card-wrapper"));
const tarjetas=window.gsap?gsap.utils.toArray(".tarjeta"):Array.from(document.querySelectorAll(".tarjeta"));

if(window.gsap&&window.ScrollTrigger&&cardsWrappers.length&&tarjetas.length){
  cardsWrappers.forEach(function(wrapper,i){
    const tarjeta=tarjetas[i];
    let scale=1;
    let rotation=0;
    if(i!==tarjetas.length-1){
      scale=0.9+0.025*i;
      rotation=-10;
    }
    gsap.to(tarjeta,{scale:scale,rotationX:rotation,transformOrigin:"top center",ease:"none",scrollTrigger:{trigger:wrapper,start:"top "+(80+10*i),end:"bottom 550",endTrigger:".wrapper",scrub:true,pin:wrapper,pinSpacing:false,onUpdate:function(self){
      if(i===tarjetas.length-1){tarjeta.style.filter="none";}
      else{
        const blurAmount=gsap.utils.mapRange(0,1,0,3,self.progress);
        tarjeta.style.filter="blur("+blurAmount+"px)";
      }
    },markers:false,id:i+1}});
  });
}

(function(factory){
  if(window.jQuery){factory(window.jQuery);}
  else{
    document.addEventListener('DOMContentLoaded',function(){
      if(window.jQuery)factory(window.jQuery);
      else console.error('[trabajos] jQuery no está cargado. Incluí jquery-3.5.1.min antes de index.js');
    });
  }
})(function($){
  var io=null;
  var footerStarted=false;
  var logosStarted=false;
  var flowStarted=false;

  function joinClean(){
    var out='',i=0;
    for(i=0;i<arguments.length;i++){
      var p=String(arguments[i]||'');
      if(!p)continue;
      if(i===0)out=p.replace(/\/+$/,'');
      else out=(out+'/'+p.replace(/^\/+/,'')).replace(/([^:]\/)\/+/g,'$1');
    }
    return out;
  }

  function guessBase(){
    var baseTag=document.querySelector('base[href]');
    if(baseTag)return String(baseTag.getAttribute('href')).replace(/\/+$/,'');
    if(typeof window.BASEURL==='string'&&window.BASEURL.length)return String(window.BASEURL).replace(/\/+$/,'');
    var parts=location.pathname.split('/').filter(Boolean);
    if(parts.length>0)return location.origin+'/'+parts[0];
    return location.origin;
  }

  function resolveCfg(){
    var $zone=$('#trabajos');
    var baseAttr=$zone.attr('data-base');
    var base=(baseAttr&&baseAttr.length?baseAttr:guessBase());
    base=String(base).replace(/\/+$/,'');
    var apiAttr=$zone.attr('data-api');
    var api=apiAttr&&apiAttr.length?apiAttr:joinClean(base,'api/pages.php');
    var $row=$zone.find('.row');
    if(!$row.length)$row=$('<div class="row"></div>').appendTo($zone);
    return{base:base,api:api,$zone:$zone,$row:$row};
  }

  function wait(ms){return new Promise(function(res){setTimeout(res,ms);});}

  function ensureStyles(){
    if(document.getElementById('trabajos-overlay-style'))return;
    var s=document.createElement('style');
    s.id='trabajos-overlay-style';
    s.textContent='@keyframes tspin{to{transform:rotate(360deg)}} #trabajos{position:relative} .trabajos-overlay{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:transparent;pointer-events:none;z-index:3} .trabajos-overlay .tbox{display:flex;flex-direction:column;align-items:center;gap:12px;padding:14px 16px;border-radius:12px;background:rgba(255,255,255,.06);backdrop-filter:saturate(120%) blur(2px)} .trabajos-overlay .spinner{width:32px;height:32px;border:3px solid rgba(255,255,255,.25);border-top-color:#fff;border-radius:50%;animation:tspin 1s linear infinite} .trabajos-overlay .msg{color:#fff;font-weight:600;font-size:14px} .trabajos-overlay.error{pointer-events:auto} .trabajos-overlay .retry{margin-top:4px;padding:8px 14px;border:0;border-radius:8px;background:#fff;color:#000;cursor:pointer}';
    document.head.appendChild(s);
  }

  function overlay($zone,state,msgHtml){
    ensureStyles();
    var $ov=$zone.children('.trabajos-overlay');
    if(!$ov.length){
      $ov=$('<div class="trabajos-overlay"><div class="tbox"></div></div>');
      $zone.append($ov);
    }
    $ov.removeClass('error');
    var html='';
    if(state==='loading'){
      html='<div class="spinner" aria-label="cargando"></div><div class="msg">Cargando trabajos…</div>';
    }else if(state==='error'){
      $ov.addClass('error');
      html=msgHtml||'<div class="msg">No pudimos cargar los proyectos</div><button class="retry">Reintentar</button>';
    }else{
      $ov.remove();
      return;
    }
    $ov.find('.tbox').html(html);
  }

  function previewText(x,limit){
    if(!x)return '';
    var s=String(x);
    if(s.length<=limit)return s;
    return s.slice(0,limit)+'…';
  }

  function explainAjaxError(cfg,xhr,status,err){
    var reason='';
    if(status==='timeout') reason='Timeout de la petición';
    else if(status==='parsererror') reason='La respuesta no es JSON válido';
    else if(xhr&&xhr.status===0) reason='Sin respuesta. Ruta inválida o CORS';
    else reason=(xhr&&xhr.status?xhr.status+' '+(xhr.statusText||''):status||'Error desconocido');
    var body=previewText(xhr&&xhr.responseText,380);
    var html='<div class="msg" style="text-align:left;max-width:520px">'+
      '<strong>No pudimos cargar los proyectos</strong><br><small>Diagnóstico visible</small><hr style="opacity:.25">'+
      '<div><b>Base:</b> '+cfg.base+'</div>'+
      '<div><b>API:</b> '+cfg.api+'</div>'+
      '<div><b>Estado:</b> '+reason+'</div>'+
      '<div><b>jQuery status:</b> '+(status||'-')+'</div>'+
      (err?('<div><b>Error:</b> '+err+'</div>'):'')+
      (body?('<div style="margin-top:8px"><b>Respuesta:</b><pre style="white-space:pre-wrap;max-height:180px;overflow:auto;margin:6px 0 0">'+$('<div>').text(body).html()+'</pre></div>'):'')+
      '<div style="margin-top:10px"><button class="retry">Reintentar</button></div>'+
    '</div>';
    return html;
  }

  function kAsset(base,file,subdir){
    if(!file)return'';
    var p=String(file).trim();
    if(/^https?:\/\//i.test(p))return p;
    if(p[0]==='/')return joinClean(base,p);
    if(p.indexOf('/')!==-1)return joinClean(base,p);
    return joinClean(base,'admin',subdir,p);
  }
  function kLogo(base,file){return kAsset(base,file,'pages_img');}
  function kVideo(base,file){return kAsset(base,file,'pages_videos');}
  function kPoster(base,file){return kAsset(base,file,'pages_videos');}

  function isImageBg(file){
    if(!file)return false;
    var a=document.createElement('a');a.href=file;
    var ext=(a.pathname.split('.').pop()||'').toLowerCase();
    return ext==='jpg'||ext==='jpeg'||ext==='png';
  }
  function isVideoBg(file){
    if(!file)return false;
    var a=document.createElement('a');a.href=file;
    var ext=(a.pathname.split('.').pop()||'').toLowerCase();
    return ext==='mp4';
  }

  function kHref(base,url){
    if(!url)return'#';
    if(/^https?:\/\//i.test(url))return url;
    var u=String(url).replace(/^\/+/,'');
    if(u.indexOf('trabajos/')!==0)u='trabajos/'+u;
    return joinClean(base,u);
  }

  function buildCard(base,row){
    var href=kHref(base,row.page_url||'');
    var videoFile=row.page_video||'';
    var posterFile=row.page_video_poster||'';
    var videoUrl=kVideo(base,videoFile);
    var posterUrl=kPoster(base,posterFile);
    var logoUrl=kLogo(base,row.page_logo_overlay||'');
    var isImg=isImageBg(videoFile);
    var isVid=isVideoBg(videoFile);
    var hasPoster=isImageBg(posterFile);
    var $col=$('<div class="col-lg-4 col-md-6 col-sm-6 col-12"></div>');
    var $wrap=$('<div class="single-case-main-wrapper"></div>').appendTo($col);
    var $a=$('<a class="pli-image-link"></a>').attr('href',href).appendTo($wrap);
    var $holder=$('<div class="pli-image-holder"></div>').appendTo($a);
    var $fig=$('<figure class="pli-image"></figure>').appendTo($holder);
    if(videoUrl&&isVid){
      var $vw=$('<div class="video-wrap"></div>').appendTo($fig);
      var $v=$('<video class="proj-video w-100 image-blur-target" playsinline muted loop autoplay preload="metadata"></video>').attr('data-src',videoUrl);
      if(hasPoster)$v.attr('poster',posterUrl);
      $vw.append($v);
    }else if(videoUrl&&isImg){
      $('<img class="image-blur-target" alt="image">').attr('src',videoUrl).attr('data-src',videoUrl).appendTo($fig);
    }else if(hasPoster){
      $('<img class="image-blur-target" alt="image">').attr('src',posterUrl).attr('data-src',posterUrl).appendTo($fig);
    }else if(logoUrl){
      $('<img class="image-blur-target" alt="logo">').attr('src',logoUrl).attr('data-src',logoUrl).appendTo($fig);
    }
    if(logoUrl){
      var $overlay=$('<div class="logo-overlay"></div>').appendTo($holder);
      $('<img class="logo-image" alt="logo">').attr('src',logoUrl).appendTo($overlay);
    }
    return $col;
  }

  function bootVideo(w){
    var v=w.querySelector('video');
    if(!v||v.dataset.started)return;
    v.dataset.started='1';
    v.loop=true;
    v.muted=true;
    v.playsInline=true;
    v.autoplay=true;
    if(!v.src&&v.dataset.src){v.src=v.dataset.src;}
    v.addEventListener('ended',function(){try{v.currentTime=0;v.play().catch(function(){});}catch(e){}});
    v.addEventListener('canplay',function(){v.play().catch(function(){});},{once:true});
    v.load();
  }

  function initObserver(){
    if(io)return io;
    if(!('IntersectionObserver'in window)){
      $('.video-wrap').each(function(){bootVideo(this);});
      return null;
    }
    io=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(!entry.isIntersecting)return;
        bootVideo(entry.target);
      });
    },{threshold:0.5});
    $('.video-wrap').each(function(){io.observe(this);});
    return io;
  }

  function render(base,$row,list){
    $row.empty();
    if(!list||!list.length){
      overlay($row.closest('#trabajos'),'error','<div class="msg"><strong>No pudimos cargar los proyectos</strong><br><small>La API respondió vacío</small><div style="margin-top:10px"><button class="retry">Reintentar</button></div></div>');
    }else{
      var frag=$(document.createDocumentFragment());
      for(var i=0;i<list.length;i++){frag.append(buildCard(base,list[i]));}
      $row.append(frag);
      initObserver();
      overlay($row.closest('#trabajos'),null);
    }
    if(window.ScrollTrigger){setTimeout(function(){ScrollTrigger.refresh();},0);}
  }

  function fetchProjectsOnce(){
    return new Promise(function(resolve){
      var cfg=resolveCfg();
      if(!cfg.$zone.length){
        resolve(false);
        return;
      }
      overlay(cfg.$zone,'loading');
      $.ajax({url:cfg.api,dataType:'json',cache:true,timeout:15000})
      .done(function(resp){
        var list=[];
        if(resp&&resp.ok&&Array.isArray(resp.data))list=resp.data;
        else if(Array.isArray(resp))list=resp;
        render(cfg.base,cfg.$row,list);
        resolve(true);
      })
      .fail(function(xhr,status,err){
        var html=explainAjaxError(cfg,xhr,status,err);
        overlay(cfg.$zone,'error',html);
        resolve(false);
      });
    });
  }

  function initLogosSection(){
    if(logosStarted)return;
    logosStarted=true;
    if(window.gsap&&window.ScrollTrigger){
      gsap.registerPlugin(ScrollTrigger);
      const blurOverlay=document.querySelector(".blur-overlay");
      const tl=gsap.timeline({scrollTrigger:{trigger:".section-logos",start:"top top",end:"+=170%",scrub:true,pin:true,pinSpacing:true,onUpdate:function(self){if(blurOverlay)blurOverlay.style.opacity=self.progress>0.5?1:0;}}});
      tl.to(".section-logos",{backgroundColor:"#ffffff",duration:0.15},0);
      tl.to(".section-logos .before-title:first-of-type",{opacity:1,y:0,duration:0.35},0.1);
      tl.to(".section-logos h3",{opacity:1,y:0,duration:0.35},"+=0.05");
      tl.to(".section-logos .before-title:last-of-type",{opacity:1,y:0,duration:0.35},"+=0.05");
      tl.to(".animated-element",{opacity:1,y:0,duration:0.45,stagger:0.18},0.8);
      setTimeout(function(){ScrollTrigger.refresh();},0);
    }
  }

  $(document).on('click','#trabajos .trabajos-overlay .retry',function(e){
    e.preventDefault();
    runHomeFlow();
  });

  async function runHomeFlow(){
    if(flowStarted)return;
    flowStarted=true;
    var ok=await fetchProjectsOnce();
    if(window.ScrollTrigger){setTimeout(function(){ScrollTrigger.refresh();},0);}
    await wait(400);
    initLogosSection();
    if(window.ScrollTrigger){setTimeout(function(){ScrollTrigger.refresh();},0);}
    await wait(400);
    if(!footerStarted){initFooterScroll();footerStarted=true;}
  }

  if(document.readyState==='complete'||document.readyState==='interactive'){
    runHomeFlow();
  }else{
    document.addEventListener('DOMContentLoaded',runHomeFlow,{once:true});
  }
  window.addEventListener('load',function(){ setTimeout(runHomeFlow,0); });
});
