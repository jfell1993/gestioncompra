jQuery.fn.DataTable.ext.type.search.string = function ( data ) {
    return ! data ?
        '' :
        typeof data === 'string' ?
        data
            .replace( /έ/g, 'ε')
            .replace( /ύ/g, 'υ')
            .replace( /ό/g, 'ο')
            .replace( /ώ/g, 'ω')
            .replace( /ά/g, 'α')
            .replace( /ί/g, 'ι')
            .replace( /ή/g, 'η')
            .replace( /\n/g, ' ' )
            .replace( /[áÁ]/g, 'a' )
            .replace( /[éÉ]/g, 'e' )
            .replace( /[íÍ]/g, 'i' )
            .replace( /[óÓ]/g, 'o' )
            .replace( /[úÚ]/g, 'u' )
            .replace( /ê/g, 'e' )
            .replace( /î/g, 'i' )
            .replace( /ô/g, 'o' )
            .replace( /è/g, 'e' )
            .replace( /ï/g, 'i' )
            .replace( /ü/g, 'u' )
            .replace( /ã/g, 'a' )
            .replace( /õ/g, 'o' )
            .replace( /ç/g, 'c' )
            .replace( /ì/g, 'i' ) :
        data;
};