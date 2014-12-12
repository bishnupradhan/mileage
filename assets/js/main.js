/**
 * Created with JetBrains PhpStorm.
 * User: Bishnu
 * Date: 11/19/14
 * Time: 3:29 PM
 * To change this template use File | Settings | File Templates.
 */

// returns the current site URL
function base_url(ext)
{
    var ret_url = '',
        url     = window.location.href,
        base    = url.substring(0, url.indexOf('/', 14));

    // Base URL for localhost or IP
    if(base.indexOf(window.location.protocol+'//localhost') != -1 || is_ip4(base.replace(window.location.protocol+'//', ''))) {
        var pathname        = window.location.pathname,
            index1          = url.indexOf(pathname),
            index2          = url.indexOf("/", index1 + 1),
            base_local_url  = url.substr(0, index2);

        ret_url = base_local_url + "/";
    } else {
        // Root URL for domain name
        ret_url = base + "/";
    }

    if(ext !== undefined && ext !== '') {
        ret_url += ext;
    }

    return ret_url;
}

// check if url is IPv4
function is_ip4(s)
{
    var match = s.match(/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/);

    return match !== null &&
        match[1] <= 255 && match[2] <= 255 &&
        match[3] <= 255 && match[4] <= 255;
}

