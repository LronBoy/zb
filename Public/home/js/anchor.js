window.ROOTURL = location.href;

function SetShareConfig(appId, timestamp, nonceStr, signature) {
    wx.config({
        debug: false,
        appId: appId,
        timestamp: timestamp,
        nonceStr: nonceStr,
        signature: signature,
        jsApiList: [
            "onMenuShareTimeline",
            "onMenuShareAppMessage",
            "onMenuShareQQ",
            "onMenuShareWeibo",
            "onMenuShareQZone",
            'startRecord',
            'stopRecord',
            'onVoiceRecordEnd',
            'playVoice',
            'onVoicePlayEnd',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
        ]
    });
}

function PlayShareConfig(title, desc, img, titleTow, url) {

    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: titleTow,
            link: url,
            imgUrl: img,
            success: function () {
            },
            cancel: function () {
            }
        });
        wx.onMenuShareAppMessage({
            title: title,
            desc: desc,
            link: url,
            imgUrl: img,
            type: "",
            dataUrl: "",
            success: function () {
            },
            cancel: function () {
            }
        });
        wx.onMenuShareQQ({
            title: title,
            desc: desc,
            link: url,
            imgUrl: img,
            success: function () {
            },
            cancel: function () {
            }
        });
        wx.onMenuShareWeibo({
            title: title,
            desc: desc,
            link: url,
            imgUrl: img,
            success: function () {
            },
            cancel: function () {
            }
        });
        wx.onMenuShareQZone({
            title: title,
            desc: desc,
            link: url,
            imgUrl: img,
            success: function () {
            },
            cancel: function () {
            }
        });
    });
}

//获取url中的参数
var code = getUrlParam('code');

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]);
    return null; //返回参数值
}

if (code) {
    // new Image().src = location.protocol + "http://y.tuwan.com/m/Wechat/getAuthorization/?code=" + code;
}