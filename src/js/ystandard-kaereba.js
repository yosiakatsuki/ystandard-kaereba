/**
 * イベントトラッキング仕込む
 */
function event_tracking() {
    var class_list = ['kaerebalink-box', 'booklink-box', 'pochireba']
    for (var i = 0; i < class_list.length; i++) {
        var kaereba = document.getElementsByClassName(class_list[i])
        if (kaereba.length <= 0) {
            continue
        }
        for (var j = 0; j < kaereba.length ; j++) {
            var anchor = kaereba[j].getElementsByTagName('a')
            if (anchor.length <= 0) {
                continue
            }
            for (var k = 0; k < anchor.length; k++) {
                anchor[k].addEventListener('click', ga_event, false)
            }
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
    if (null != label.match('/.+www\.amazon\.co\.jp.+/')) {
        cat = cat + '-amazon'
    }
    /**
     * 楽天判定
     */
    if (null != label.match('/.+hb\.afl\.rakuten\.co\.jp.+/')) {
        cat = cat + '-rakuten'
    }
    /**
     * Apple判定
     */
    if (null != label.match('/.+itunes\.apple\.com.+/')) {
        cat = cat + '-itunes'
    }
    /**
     * イベント送信
     */
    if (typeof gtag !== 'undefined' && typeof gtag == 'function') {
        gtag('event', action, {
            'event_category': cat,
            'event_label': label
        });
    } else if (typeof ga !== 'undefined' && typeof ga == 'function') {
        ga('send', 'event', cat, action, label)
    } else if (typeof _gaq !== 'undefined') {
        _gaq.push(['_trackEvent', cat, action, label])
    }
}

event_tracking()