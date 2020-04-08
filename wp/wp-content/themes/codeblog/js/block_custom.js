// (function () {
//     //使用するメソッド
//     var el = wp.element.createElement,
//         blocks = wp.blocks;

//     // カスタムブロックの追加
//     blocks.registerBlockType('core/heading', {
//         title: 'サンプルブロック01',
//         icon: 'wordpress-alt',
//         category: 'layout',
//         edit: function () {
//             return el(
//                 'div',
//                 {
//                     className: "example-1",
//                     style: {
//                         backgroundColor: '#900',
//                         color: '#fff',
//                         padding: '1em',
//                     }
//                 },
//                 'エディタ側ではDIVタグだよ'
//             );
//         },
//         save: function () {
//             return el(
//                 'p',
//                 {
//                     className: "example-1",
//                     style: {
//                         backgroundColor: '#008000',
//                         color: '#fff',
//                         padding: '1em',
//                     }
//                 },
//                 'サイト表示側ではPタグだよ'
//             );
//         },
//     });
// })();
