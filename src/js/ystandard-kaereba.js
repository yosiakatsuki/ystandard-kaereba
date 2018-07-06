/**
 * イベントトラッキング仕込む
 */
function event_tracking() {
    var class_list = ['kaerebalink-box','booklink-box']
    for (var i = 0; i < class_list.length; i++) {
        var kaereba = document.getElementsByClassName( class_list[i] )
        if( kaereba.length <= 0 ){
            continue
        }
        var anchor = kaereba[i].getElementsByTagName( 'a' )
        if( anchor.length <= 0 ){
            continue
        }
        for (var j = 0; j < anchor.length; j++) {
            anchor[j].addEventListener( 'click', ga_event, false )
        }
    }
}

/**
 * イベントトラッキング実行
 */
function ga_event() {
    var cat = 'kaereba',
        action = 'click',
        label = this.getAttribute('href')
    /**
     * Amazon判定
     */
    if( null != label.match( '/.+www\.amazon\.co\.jp.+/' ) ) {
        cat = 'kaereba-amazon'
    }
    /**
     * 楽天判定
     */
    if( null != label.match( '/.+hb\.afl\.rakuten\.co\.jp.+/' ) ) {
        cat = 'kaereba-rakuten'
    }
    /**
     * イベント送信
     */
    if (typeof gtag !== 'undefined' && $.isFunction(gtag)) {
        gtag('event', action, {
            'event_category': cat,
            'event_label': label
        });
    } else if (typeof ga !== 'undefined'  && $.isFunction(ga)) {
        ga( 'send', 'event', cat, action, label );
    } else if (typeof _gaq !== 'undefined') {
        _gaq.push(['_trackEvent', cat, action, label]);
    }
}

event_tracking()