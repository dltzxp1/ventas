
function replaceWith(a,b){
    var c=document.getElementById(a),d=document.createElement("div");
    d.innerHTML=b,/\bcompact\b/.test(c.className)&&(d.childNodes[0].className+=" compact"),c.parentNode.replaceChild(d.childNodes[0],c)
    }
    function getCookie(a){
    var b,c;
    if(document.cookie.length>0){
        b=document.cookie.indexOf(a+"=");
        if(b!=-1)return b+=a.length+1,c=document.cookie.indexOf(";",b),c==-1&&(c=document.cookie.length),unescape(document.cookie.substring(b,c))
            }
            return""
    }
    function redirect(a){
    window.open(a,"_blank")
    }
    var Try={
    these:function(){
        var a;
        for(var b=0,c=arguments.length;b<c;b++){
            var d=arguments[b];
            try{
                a=d();
                break
            }catch(e){}
        }
        return a
    }
},Ajax={
    evalJSON:function(json){
        return eval("("+json+")")
        },
    getTransport:function(){
        return Try.these(function(){
            return new XMLHttpRequest
            },function(){
            return new ActiveXObject("Msxml2.XMLHTTP")
            },function(){
            return new ActiveXObject("Msxml3.XMLHTTP")
            },function(){
            return new ActiveXObject("Microsoft.XMLHTTP")
            })||!1
        },
    request:function(a,b,c){
        var d=this.getTransport();
        if(!d)return;
        if(null!==b&&"function"==typeof b)b.onSuccess=b;
        else if(!b.onSuccess)return!1;
        var e=c?"post":b.method?b.method:"get";
        d.open(e,a,!0),d.setRequestHeader("X-REQUESTED-WITH","XMLHttpRequest");
        var f=getCookie("f_rt");
        f&&(b.headers={
            "REQUEST-TOKEN":f
        });
        if(b.headers)for(header in b.headers)d.setRequestHeader("X-"+header,b.headers[header]);e=="post"&&d.setRequestHeader("Content-type","application/x-www-form-urlencoded"),d.onreadystatechange=function(){
            if(d.readyState!=4)return;
            if(d.status!=200&&d.status!=304){
                b.onFailure&&b.onFailure(d.status,d.responseText);
                return
            }
            b.onSuccess(d.responseText)
            };
            
        if(d.readyState==4)return;
        return d.send(c),!0
        }
    },FlattrButton={
    click:function(a){
        var b={
            onSuccess:function(a){
                window.parent.postMessage(JSON.stringify({
                    flattr_button_event:"click_successful"
                }),"*"),replaceWith("flattr-1",a),setTimeout(function(){
                    var a=document.querySelectorAll(".flattr-button");
                    a[0].className=a[0].className+" show-share",setTimeout(function(){
                        a[0].className=a[0].className.replace("show-share","")
                        },3e3)
                    },1),FlattrButton.init()
                },
            onFailure:function(a,b){
                (a==410||a==402)&&window.location.reload(!0)
                }
            };
        
    Ajax.request(a,b)||window.location.reload(!0)
    },
fakeReplace:function(a){
    "flattr-flattred"==a.className?a.className="flattr-subscribed":"flattr-link"==a.className&&(a.className="flattr-flattred")
    },
init:function(){
    if(!document.querySelectorAll){
        var a=document.getElementsByTagName("div")[0];
        a.parentNode.removeChild(a);
        return
    }
    var b,c,d=document.querySelectorAll(".flattr");
    for(b=0,c=d.length;b<c;b++){
        var e=d[b].href;
        /\bflattr-ajax\b/.test(d[b].className)?d[b].onclick=function(){
            var a=this.getElementsByTagName("span");
            return a&&FlattrButton.fakeReplace(a[0]),FlattrButton.click(e),!1
            }:/\bflattr-pop\b/.test(d[b].className)?d[b].onclick=function(){
            return FlattrButton.popup(e,this),!1
            }:/\bflattr-ed\b/.test(d[b].className)&&(d[b].onclick=function(){
            return FlattrButton.compact(e),!1
            })
        }
        d=document.querySelectorAll(".services a");
    for(b=0,c=d.length;b<c;b++)d[b].onclick=FlattrButton.openShare
        },
openShare:function(){
    return flattrPopupWin=window.open(this.href,"FlattrShare-"+this.className.replace(" ","-"),"height=450,width=550"),flattrPopupWin.focus(),!1
    },
compact:function(a){
    var b=new RegExp("^(http(?:s)?)://api.([^/]+)/(.+)","im"),c=a.match(b);
    url=c[1].toString()+"://"+c[2].toString()+"/"+c[3].toString(),flattrPopupWin=window.open(url,"Flattr","menubar=0,resizable=1,width=705,height=330,scrollbars=1,status=0,toolbar=0,location=0,directories=0"),flattrPopupWin.focus()
    },
popup:function(a,b){
    var c=new RegExp("^(?:f|ht)tp(?:s)?://api.([^/]+)","im"),d=window.location.href.match(c)[1].toString(),e=a.split("/"),f=e[e.length-1];
    fixedHref="http://"+d+"/compact/thing/id/"+f,flattrPopupWin=window.open(fixedHref),flattrPopupWin.focus()
    }
};

window.onload=function(){
    FlattrButton.init()
    }