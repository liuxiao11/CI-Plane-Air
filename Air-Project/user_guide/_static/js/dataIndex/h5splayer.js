function H5sPlayerWS(t) {
    var s;
    this.sourceBuffer, this.buffer = [], this.t, this.video, this.s, this.i, this.o, this.h = 0, this.l = 0, this.u = 0, this.S = !1, this.v = !1, this.p = !1, this.H, this.k = t, console.log("Websocket Conf:", t), this.P = t.videoid, this.C = t.pbconf, this.W = t.token, void 0 === this.P ? (this.m = t.videodom, console.log(t.token, "use dom directly")) : (this.m = document.getElementById(this.P), console.log(t.token, "use videoid")), this.video = this.m, null != this.C && "false" == this.C.showposter || (s = this.k.protocol + "//" + this.k.host + this.k.rootpath + "api/v1/GetImage?token=" + this.W + "&session=" + this.k.session, console.log(t.token, "connect src"), this.m.setAttribute("poster", s))
}
function H5sPlayerRTC(t) {
    var s;
    this.s, this.i, this.o, this.h = 0, this.l = 0, this.u = 0, this.S = !1, this.v = !1, this.k = t, this.P = t.videoid, this.C = t.pbconf, this.W = t.token, void 0 === this.P ? (this.m = t.videodom, console.log(t.token, "use dom directly")) : (this.m = document.getElementById(this.P), console.log(t.token, "use videoid")), this.video = this.m, this.R = null, this.I = {optional: [{DtlsSrtpKeyAgreement: !0}]}, this.A = {
        mandatory: {
            offerToReceiveAudio: !0,
            offerToReceiveVideo: !0
        }
    }, this.T = {M: []}, this.O = [], null != this.C && "false" == this.C.showposter || (s = this.k.protocol + "//" + this.k.host + this.k.rootpath + "api/v1/GetImage?token=" + this.W + "&session=" + this.k.session, console.log("connect src", t.token), this.m.setAttribute("poster", s))
}
function createRTCSessionDescription(t) {
    return console.log("createRTCSessionDescription "), new RTCSessionDescription(t)
}
function H5sPlayerHls(t) {
    this.s, this.o, this.k = t, this.P = t.videoid, this.W = t.token, this.J, this.N = t.hlsver, void 0 === this.P ? (this.m = t.videodom, console.log(t.token, "use dom directly")) : (this.m = document.getElementById(this.P), console.log(t.token, "use videoid")), this.g = this.m, this.g.type = "application/x-mpegURL", this.B = 0, this.U = 0;
    var s = this.k.protocol + "//" + window.location.host + "/api/v1/GetImage?token=" + this.W + "&session=" + this.k.session;
    this.m.setAttribute("poster", s)
}
function H5sPlayerAudio(t) {
    this.buffer = [], this.s, this.S = !1, this.v = !1, this.k = t, console.log("Aduio Player Conf:", t), this.W = t.token, this._ = new AudioContext
}
function H5sPlayerAudBack(t) {
    this.buffer = [], this.s, this.S = !1, this.v = !1, this.k = t, this.L = 0, this.D = 48e3, this.G = !1, console.log("Aduio Back Conf:", t), this.W = t.token, this._ = new AudioContext, console.log("sampleRate", this._.sampleRate), this.K()
}
function float32ToInt16(t) {
    for (var s = t.length, e = new Int16Array(s); s--;)e[s] = 32767 * Math.min(1, t[s]);
    return e
}
H5sPlayerWS.prototype.V = function () {
    !0 === this.S && (console.log("Reconnect..."), this.j(this.W), this.S = !1)
}, H5sPlayerWS.prototype.q = function (t) {
    var s;
    console.log("H5SWebSocketClient");
    try {
        "http:" == this.k.protocol && (s = "undefined" != typeof MozWebSocket ? new MozWebSocket("ws://" + this.k.host + t) : new WebSocket("ws://" + this.k.host + t)), "https:" == this.k.protocol && (console.log(this.k.host), s = "undefined" != typeof MozWebSocket ? new MozWebSocket("wss://" + this.k.host + t) : new WebSocket("wss://" + this.k.host + t)), console.log(this.k.host)
    } catch (t) {
        return void alert("error")
    }
    return s
}, H5sPlayerWS.prototype.F = function () {
    if (null !== this.sourceBuffer && void 0 !== this.sourceBuffer) {
        if (0 !== this.buffer.length && !this.sourceBuffer.updating)try {
            var t = this.buffer.shift(), s = new Uint8Array(t);
            this.sourceBuffer.appendBuffer(s)
        } catch (t) {
            console.log(t)
        }
    } else console.log(this.sourceBuffer, "is null or undefined")
}, H5sPlayerWS.prototype.X = function () {
    try {
        var t = {cmd: "H5_KEEPALIVE"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerWS.prototype.Y = function (t) {
    return t.data, ArrayBuffer, "string" == typeof t.data ? (console.log("string"), void(null != this.C && null != this.C.callback && this.C.callback(t.data, this.C.userdata))) : !0 !== this.v ? !1 === this.p ? (this.H = String.fromCharCode.apply(null, new Uint8Array(t.data)), this.Z(this), void(this.p = !0)) : (this.buffer.push(t.data), void this.F()) : void 0
}, H5sPlayerWS.prototype.Z = function (t) {
    try {
        window.MediaSource = window.MediaSource || window.WebKitMediaSource, window.MediaSource || console.log("MediaSource API is not available");
        var s = 'video/mp4; codecs="avc1.42E01E, mp4a.40.2"';
        "MediaSource" in window && MediaSource.isTypeSupported(s) ? console.log("MIME type or codec: ", s) : console.log("Unsupported MIME type or codec: ", s), t.t = new window.MediaSource, t.video.autoplay = !0, console.log(t.P);
        t.video.src = window.URL.createObjectURL(t.t), t.video.play(), t.t.addEventListener("sourceopen", t.$.bind(t), !1)
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerWS.prototype.$ = function () {
    console.log("Add SourceBuffer"), this.sourceBuffer = this.t.addSourceBuffer(this.H), this.t.duration = 1 / 0, this.t.removeEventListener("sourceopen", this.$, !1), this.sourceBuffer.addEventListener("updateend", this.F.bind(this), !1)
}, H5sPlayerWS.prototype.j = function (t) {
    this.video.autoplay = !0;
    var s = "api/v1/h5swsapi", e = "main";
    if (void 0 === this.k.streamprofile || (e = this.k.streamprofile), void 0 === this.C) s = this.k.rootpath + s + "?token=" + t + "&profile=" + e + "&session=" + this.k.session; else {
        var i = "false", o = "fake";
        void 0 === this.C.serverpb || (i = this.C.serverpb), void 0 === this.C.filename || (o = this.C.filename), s = this.k.rootpath + s + "?token=" + t + "&playback=true&profile=" + e + "&serverpb=" + i + "&begintime=" + encodeURIComponent(this.C.begintime) + "&endtime=" + encodeURIComponent(this.C.endtime) + "&filename=" + o + "&session=" + this.k.session
    }
    this.k.session, console.log(s), this.s = this.q(s), console.log("setupWebSocket", this.s), this.s.binaryType = "arraybuffer", (this.s.tt = this).s.onmessage = this.Y.bind(this), this.s.onopen = function () {
        console.log("wsSocket.onopen", this.tt), this.tt.i = setInterval(this.tt.st.bind(this.tt), 1e4), this.tt.o = setInterval(this.tt.X.bind(this.tt), 1e3), null != this.tt.C && "true" === this.tt.C.autoplay && this.tt.start()
    }, this.s.onclose = function () {
        console.log("wsSocket.onclose", this.tt), !0 === this.tt.v ? console.log("wsSocket.onclose disconnect") : this.tt.S = !0, this.tt.et(this.tt), this.tt.it(this.tt), this.tt.H = "", this.tt.p = !1
    }
}, H5sPlayerWS.prototype.et = function (t) {
    console.log("Cleanup Source Buffer", t);
    try {
        t.sourceBuffer.removeEventListener("updateend", t.F, !1), t.sourceBuffer.abort(), document.documentMode || /Edge/.test(navigator.userAgent) ? console.log("IE or EDGE!") : t.t.removeSourceBuffer(t.sourceBuffer), t.sourceBuffer = null, t.t = null, t.buffer = []
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerWS.prototype.it = function (t) {
    console.log("CleanupWebSocket", t), clearInterval(t.o), clearInterval(t.i), t.h = 0, t.l = 0, t.u = 0
}, H5sPlayerWS.prototype.st = function () {
    if (void 0 === this.C) {
        !0 === this.v && (console.log("CheckSourceBuffer has been disconnect", this), clearInterval(this.o), clearInterval(this.i), clearInterval(this.ot));
        try {
            if (console.log("CheckSourceBuffer", this), this.sourceBuffer.buffered.length <= 0) {
                if (this.h++, 8 < this.h)return console.log("CheckSourceBuffer Close 1"), void this.s.close()
            } else {
                this.h = 0;
                this.sourceBuffer.buffered.start(0);
                var t = this.sourceBuffer.buffered.end(0), s = t - this.video.currentTime;
                if (5 < s || s < 0)return console.log("CheckSourceBuffer Close 2", s), void this.s.close();
                if (t == this.l) {
                    if (this.u++, 3 < this.u)return console.log("CheckSourceBuffer Close 3"), void this.s.close()
                } else this.u = 0;
                this.l = t
            }
        } catch (t) {
            console.log(t)
        }
    }
}, H5sPlayerWS.prototype.connect = function () {
    this.j(this.W), this.ot = setInterval(this.V.bind(this), 3e3)
}, H5sPlayerWS.prototype.disconnect = function () {
    console.log("disconnect", this), this.v = !0, clearInterval(this.ot), null != this.s && (this.s.close(), this.s = null), console.log("disconnect", this)
}, H5sPlayerWS.prototype.start = function () {
    try {
        var t = {cmd: "H5_START"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerWS.prototype.pause = function () {
    try {
        var t = {cmd: "H5_PAUSE"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerWS.prototype.resume = function () {
    try {
        var t = {cmd: "H5_RESUME"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerWS.prototype.seek = function (t) {
    try {
        var s = {cmd: "H5_SEEK"};
        s.nSeekTime = t, this.s.send(JSON.stringify(s))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerWS.prototype.speed = function (t) {
    try {
        var s = {cmd: "H5_SPEED"};
        s.nSpeed = t, this.s.send(JSON.stringify(s))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerRTC.prototype.V = function () {
    !0 === this.S && (console.log("Reconnect..."), this.j(this.W), this.S = !1)
}, H5sPlayerRTC.prototype.q = function (t) {
    var s;
    console.log("H5SWebSocketClient");
    try {
        "http:" == this.k.protocol && (s = "undefined" != typeof MozWebSocket ? new MozWebSocket("ws://" + this.k.host + t) : new WebSocket("ws://" + this.k.host + t)), "https:" == this.k.protocol && (console.log(this.k.host), s = "undefined" != typeof MozWebSocket ? new MozWebSocket("wss://" + this.k.host + t) : new WebSocket("wss://" + this.k.host + t)), console.log(this.k.host)
    } catch (t) {
        return void alert("error")
    }
    return s
}, H5sPlayerRTC.prototype.X = function () {
    try {
        var t = {type: "keepalive"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerRTC.prototype.nt = function (t) {
    if (t.candidate) {
        var s;
        console.log("onIceCandidate currentice", t.candidate), s = t.candidate, console.log("onIceCandidate currentice", s, JSON.stringify(s));
        var e = JSON.parse(JSON.stringify(s));
        e.type = "remoteice", console.log("onIceCandidate currentice new", e, JSON.stringify(e)), this.s.send(JSON.stringify(e))
    } else console.log("End of candidates.")
}, H5sPlayerRTC.prototype.ht = function (t) {
    var s;
    console.log("Remote track added:" + JSON.stringify(t)), s = t.ct ? t.ct[0] : t.stream;
    var e = this.m;
    e.src = URL.createObjectURL(s), e.play()
}, H5sPlayerRTC.prototype.rt = function () {
    console.log("createPeerConnection  config: " + JSON.stringify(this.T) + " option:" + JSON.stringify(this.I));
    var s = new RTCPeerConnection(this.T, this.I), e = this;
    return s.onicecandidate = function (t) {
        e.nt.call(e, t)
    }, void 0 !== s.lt ? s.lt = function (t) {
        e.ht.call(e, t)
    } : s.onaddstream = function (t) {
        e.ht.call(e, t)
    }, s.oniceconnectionstatechange = function (t) {
        console.log("oniceconnectionstatechange  state: " + s.iceConnectionState)
    }, console.log("Created RTCPeerConnnection with config: " + JSON.stringify(this.T) + "option:" + JSON.stringify(this.I)), s
}, H5sPlayerRTC.prototype.at = function (t) {
    console.log("ProcessRTCOffer", t);
    try {
        this.R = this.rt(), this.O.length = 0;
        var s = this;
        this.R.setRemoteDescription(createRTCSessionDescription(t)), this.R.createAnswer(this.A).then(function (t) {
            console.log("Create answer:" + JSON.stringify(t)), s.R.setLocalDescription(t, function () {
                console.log("ProcessRTCOffer createAnswer", t), s.s.send(JSON.stringify(t))
            }, function () {
            })
        }, function (t) {
            alert("Create awnser error:" + JSON.stringify(t))
        })
    } catch (t) {
        this.disconnect(), alert("connect error: " + t)
    }
}, H5sPlayerRTC.prototype.ut = function (t) {
    console.log("ProcessRemoteIce", t);
    try {
        var s = new RTCIceCandidate({sdpMLineIndex: t.sdpMLineIndex, candidate: t.candidate});
        console.log("ProcessRemoteIce", s), console.log("Adding ICE candidate :" + JSON.stringify(s)), this.R.addIceCandidate(s, function () {
            console.log("addIceCandidate OK")
        }, function (t) {
            console.log("addIceCandidate error:" + JSON.stringify(t))
        })
    } catch (t) {
        alert("connect ProcessRemoteIce error: " + t)
    }
}, H5sPlayerRTC.prototype.Y = function (t) {
    t.data, ArrayBuffer, t.data, console.log("RTC received ", t.data);
    var s = JSON.parse(t.data);
    return console.log("Get Message type ", s.type), "offer" === s.type ? (console.log("Process Message type ", s.type), void this.at(s)) : "remoteice" === s.type ? (console.log("Process Message type ", s.type), void this.ut(s)) : void(null != this.C && null != this.C.callback && this.C.callback(t.data, this.C.userdata))
}, H5sPlayerRTC.prototype.j = function (t) {
    this.video.autoplay = !0;
    var s = "api/v1/h5srtcapi", e = "main";
    if (void 0 === this.k.streamprofile || (e = this.k.streamprofile), void 0 === this.C) s = this.k.rootpath + s + "?token=" + t + "&profile=" + e + "&session=" + this.k.session; else {
        var i = "false", o = "fake";
        void 0 === this.C.serverpb || (i = this.C.serverpb), void 0 === this.C.filename || (o = this.C.filename), s = this.k.rootpath + s + "?token=" + t + "&playback=true&profile=" + e + "&serverpb=" + i + "&begintime=" + encodeURIComponent(this.C.begintime) + "&endtime=" + encodeURIComponent(this.C.endtime) + "&filename=" + o + "&session=" + this.k.session
    }
    console.log(s), this.s = this.q(s), console.log("setupWebSocket", this.s), this.s.binaryType = "arraybuffer", (this.s.tt = this).s.onmessage = this.Y.bind(this), this.s.onopen = function () {
        console.log("wsSocket.onopen", this.tt);
        var t = {type: "open"};
        this.tt.s.send(JSON.stringify(t)), this.tt.o = setInterval(this.tt.X.bind(this.tt), 1e3), null != this.tt.C && "true" === this.tt.C.autoplay && this.tt.start()
    }, this.s.onclose = function () {
        console.log("wsSocket.onclose", this.tt), !0 === this.tt.v ? console.log("wsSocket.onclose disconnect") : this.tt.S = !0, this.tt.it(this.tt)
    }
}, H5sPlayerRTC.prototype.it = function (t) {
    console.log("CleanupWebSocket", t), clearInterval(t.o), t.h = 0, t.l = 0, t.u = 0
}, H5sPlayerRTC.prototype.connect = function () {
    this.j(this.W), this.ot = setInterval(this.V.bind(this), 3e3)
}, H5sPlayerRTC.prototype.disconnect = function () {
    if (console.log("disconnect", this), this.v = !0, clearInterval(this.ot), null != this.s && (this.s.close(), this.s = null), this.m && (this.m.src = ""), this.R) {
        try {
            this.R.close()
        } catch (t) {
            console.log("close peer connection failed:" + t)
        }
        this.R = null
    }
    console.log("disconnect", this)
}, H5sPlayerRTC.prototype.start = function () {
    try {
        var t = {cmd: "H5_START"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerRTC.prototype.pause = function () {
    try {
        var t = {cmd: "H5_PAUSE"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerRTC.prototype.resume = function () {
    try {
        var t = {cmd: "H5_RESUME"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerRTC.prototype.seek = function (t) {
    try {
        var s = {cmd: "H5_SEEK"};
        s.nSeekTime = t, this.s.send(JSON.stringify(s))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerRTC.prototype.speed = function (t) {
    try {
        var s = {cmd: "H5_SPEED"};
        s.nSpeed = t, this.s.send(JSON.stringify(s))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerHls.prototype.q = function (t) {
    var s;
    console.log("H5SWebSocketClient");
    try {
        "http:" == this.k.protocol && (s = "undefined" != typeof MozWebSocket ? new MozWebSocket("ws://" + this.k.host + t) : new WebSocket("ws://" + this.k.host + t)), "https:" == this.k.protocol && (console.log(this.k.host), s = "undefined" != typeof MozWebSocket ? new MozWebSocket("wss://" + this.k.host + t) : new WebSocket("wss://" + this.k.host + t)), console.log(this.k.host)
    } catch (t) {
        return void alert("error")
    }
    return s
}, H5sPlayerHls.prototype.X = function () {
    try {
        var t = {type: "keepalive"};
        this.s.send(JSON.stringify(t))
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerHls.prototype.Y = function (t) {
    console.log("HLS received ", t.data)
}, H5sPlayerHls.prototype.j = function (t) {
    var s = "api/v1/h5swscmnapi";
    s = this.k.rootpath + s + "?token=" + t + "&session=" + this.k.session, console.log(s), this.s = this.q(s), console.log("setupWebSocket", this.s), this.s.binaryType = "arraybuffer", (this.s.tt = this).s.onmessage = this.Y.bind(this), this.s.onopen = function () {
        console.log("wsSocket.onopen", this.tt), this.tt.o = setInterval(this.tt.X.bind(this.tt), 1e3)
    }, this.s.onclose = function () {
        console.log("wsSocket.onclose", this.tt), this.tt.it(this.tt)
    }
}, H5sPlayerHls.prototype.it = function (t) {
    console.log("H5sPlayerHls CleanupWebSocket", t), clearInterval(t.o)
}, H5sPlayerHls.prototype.dt = function () {
    console.log("HLS video.ended", this.g.ended), console.log("HLS video.currentTime", this.g.currentTime);
    var t = this.g.currentTime, s = t - this.B;
    console.log("HLS diff", s), 0 === s && this.U++, this.B = t, 3 < this.U && (null != this.s && (this.s.close(), this.s = null), this.j(this.W), console.log("HLS reconnect"), this.g.src = "", this.B = 0, this.U = 0, this.g.src = this.k.protocol + "//" + this.k.host + this.k.rootpath + "hls/" + this.N + "/" + this.W + "/hls.m3u8", this.g.play())
}, H5sPlayerHls.prototype.connect = function () {
    this.j(this.W), this.B = 0, this.U = 0, this.g.onended = function (t) {
        console.log("The End")
    }, this.g.onpause = function (t) {
        console.log("Pause")
    }, this.g.onplaying = function (t) {
        console.log("Playing")
    }, this.g.onseeking = function (t) {
        console.log("seeking")
    }, this.g.onvolumechange = function (t) {
        console.log("volumechange")
    }, this.g.src = this.k.protocol + "//" + this.k.host + this.k.rootpath + "hls/" + this.N + "/" + this.W + "/hls.m3u8", this.g.play(), this.J = setInterval(this.dt.bind(this), 3e3)
}, H5sPlayerHls.prototype.disconnect = function () {
    clearInterval(this.J), this.B = 0, this.U = 0, null != this.s && (this.s.close(), this.s = null), console.log("disconnect", this)
}, H5sPlayerAudio.prototype.q = function (t) {
    var s;
    console.log("H5SWebSocketClient");
    try {
        "http:" == this.k.protocol && (s = "undefined" != typeof MozWebSocket ? new MozWebSocket("ws://" + this.k.host + t) : new WebSocket("ws://" + this.k.host + t)), "https:" == this.k.protocol && (console.log(this.k.host), s = "undefined" != typeof MozWebSocket ? new MozWebSocket("wss://" + this.k.host + t) : new WebSocket("wss://" + this.k.host + t)), console.log(this.k.host)
    } catch (t) {
        return void alert("error")
    }
    return s
}, H5sPlayerAudio.prototype.X = function () {
    try {
        this.s.send("keepalive")
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerAudio.prototype.Y = function (t) {
    for (var s = new Int16Array(t.data), e = s.length, i = this._.createBuffer(1, e, 8e3), o = 0; o < 1; o++)for (var n = i.getChannelData(o), h = 0; h < e; h++)n[h] = s[h] / 16383.5;
    var c = this._.createBufferSource();
    c.buffer = i, c.connect(this._.destination), c.start()
}, H5sPlayerAudio.prototype.it = function (t) {
    console.log("CleanupWebSocket", t), clearInterval(t.o)
}, H5sPlayerAudio.prototype.j = function (t) {
    var s = "api/v1/h5saudapi";
    s = this.k.rootpath + s + "?token=" + t + "&session=" + this.k.session, console.log(s), this.s = this.q(s), console.log("setupWebSocket for audio", this.s), this.s.binaryType = "arraybuffer", (this.s.tt = this).s.onmessage = this.Y.bind(this), this.s.onopen = function () {
        console.log("wsSocket.onopen", this.tt), this.tt.o = setInterval(this.tt.X.bind(this.tt), 1e3)
    }, this.s.onclose = function () {
        console.log("wsSocket.onclose", this.tt), this.tt.it(this.tt)
    }
}, H5sPlayerAudio.prototype.connect = function () {
    this.j(this.W)
}, H5sPlayerAudio.prototype.disconnect = function () {
    console.log("disconnect", this), null != this.s && (this.s.close(), this.s = null), console.log("disconnect", this)
}, H5sPlayerAudBack.prototype.q = function (t) {
    var s;
    console.log("H5SWebSocketClient");
    try {
        "http:" == this.k.protocol && (s = "undefined" != typeof MozWebSocket ? new MozWebSocket("ws://" + this.k.host + t) : new WebSocket("ws://" + this.k.host + t)), "https:" == this.k.protocol && (console.log(this.k.host), s = "undefined" != typeof MozWebSocket ? new MozWebSocket("wss://" + this.k.host + t) : new WebSocket("wss://" + this.k.host + t)), console.log(this.k.host)
    } catch (t) {
        return void alert("error")
    }
    return s
}, H5sPlayerAudBack.prototype.X = function () {
    try {
        this.s.send("keepalive")
    } catch (t) {
        console.log(t)
    }
}, H5sPlayerAudBack.prototype.Y = function (t) {
}, H5sPlayerAudBack.prototype.it = function (t) {
    console.log("CleanupWebSocket", t), clearInterval(t.o)
}, H5sPlayerAudBack.prototype.K = function () {
    console.log("sampleRate", this._.sampleRate), navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.ft;
    try {
        navigator.getUserMedia({video: !1, audio: !0}, this.St.bind(this))
    } catch (t) {
        return void alert("Audio back false getUserMedia", t)
    }
}, H5sPlayerAudBack.prototype.yt = function () {
    this.G = !0
}, H5sPlayerAudBack.prototype.j = function (t) {
    var s = "api/v1/h5saudbackapi";
    s = this.k.rootpath + s + "?token=" + t + "&samplerate=" + this.D + "&session=" + this.k.session, console.log(s), this.s = this.q(s), console.log("setupWebSocket for audio back", this.s), this.s.binaryType = "arraybuffer", (this.s.tt = this).s.onmessage = this.Y.bind(this), this.s.onopen = this.yt.bind(this), this.s.onclose = function () {
        console.log("wsSocket.onclose", this.tt), this.tt.it(this.tt)
    }
}, H5sPlayerAudBack.prototype.vt = function (t) {
    var s = float32ToInt16(t.inputBuffer.getChannelData(0));
    !0 === this.G && this.s && this.s.send(s)
}, H5sPlayerAudBack.prototype.St = function (t) {
    try {
        var s = this._.createMediaStreamSource(t), e = this._.createScriptProcessor(1024, 1, 1);
        s.connect(e), e.connect(this._.destination), e.onaudioprocess = this.vt.bind(this)
    } catch (t) {
        return void alert("Audio intecomm error", t)
    }
}, H5sPlayerAudBack.prototype.connect = function () {
    this.j(this.W)
}, H5sPlayerAudBack.prototype.disconnect = function () {
    console.log("disconnect", this), null != this.s && (this.s.close(), this.s = null), console.log("disconnect", this)
};