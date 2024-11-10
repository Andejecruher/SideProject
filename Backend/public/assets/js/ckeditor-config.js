// ckeditor-config.js
import {
    ClassicEditor,
    Essentials,
    Paragraph,
    Bold,
    Italic,
    Font,
    Link,
    Image,
    ImageCaption,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
    Base64UploadAdapter,
    MediaEmbed,
    Table,
    TableToolbar,
    PictureEditing,
    BlockQuote,
    Heading,
    List,
    Alignment,
    Highlight,
    HorizontalLine,
    Indent,
    IndentBlock,
    Strikethrough,
    Subscript,
    Superscript,
    Underline,
    RemoveFormat,
    CodeBlock,
    HtmlEmbed,
    PageBreak,
    PasteFromOffice,
    SpecialCharacters,
    TodoList,
    TableColumnResize,
    SimpleUploadAdapter,
    Mention,
    ImageInsert
} from 'ckeditor5';

document.addEventListener('DOMContentLoaded', function () {
    const contentElement = document.querySelector('#content');
    if (contentElement) {
        ClassicEditor
            .create(contentElement, {
                plugins: [
                    ClassicEditor,
                    Essentials,
                    Paragraph,
                    Bold,
                    Italic,
                    Font,
                    Link,
                    Image,
                    ImageCaption,
                    ImageResize,
                    ImageStyle,
                    ImageToolbar,
                    ImageUpload,
                    ImageInsert,
                    Base64UploadAdapter,
                    MediaEmbed,
                    Table,
                    TableToolbar,
                    PictureEditing,
                    BlockQuote,
                    Heading,
                    List,
                    Alignment,
                    Highlight,
                    HorizontalLine,
                    Indent,
                    IndentBlock,
                    Strikethrough,
                    Subscript,
                    Superscript,
                    Underline,
                    RemoveFormat,
                    CodeBlock,
                    HtmlEmbed,
                    PageBreak,
                    PasteFromOffice,
                    SpecialCharacters,
                    TodoList,
                    TableColumnResize,
                    SimpleUploadAdapter,
                    Mention
                ],
                toolbar: [
                    'undo', 'redo', 'heading', '|',
                    'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', '|',
                    'link', 'imageInsert', 'mediaEmbed', 'codeBlock', 'htmlEmbed', 'pageBreak', '|',
                    'specialCharacters', 'todoList', 'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells', '|',
                    'alignment', 'fontBackgroundColor', 'fontColor', 'fontFamily', 'fontSize', 'highlight', '|',
                    'horizontalLine', 'indent', 'outdent', 'strikethrough', 'subscript', 'superscript', 'underline', 'removeFormat', '|',
                ],
                image: {
                    resizeOptions: [{
                        name: 'resizeImage:original',
                        label: 'Default image width',
                        value: null,
                    },
                    {
                        name: 'resizeImage:25',
                        label: '25% page width',
                        value: '25',
                    },
                    {
                        name: 'resizeImage:50',
                        label: '50% page width',
                        value: '50',
                    },
                    {
                        name: 'resizeImage:75',
                        label: '75% page width',
                        value: '75',
                    },
                    ],
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:wrapText',
                        'imageStyle:breakText',
                        '|',
                        'resizeImage',
                    ],
                    upload: {
                        types: ['jpeg', 'png', 'gif', 'bmp', 'webp', 'tiff']
                    }
                },
                link: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    decorators: {
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                simpleUpload: {
                    uploadUrl: "{{ route('upload.image') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                table: {
                    contentToolbar: [
                        'tableColumn', 'tableRow', 'mergeTableCells'
                    ]
                },
                mediaEmbed: {
                    previewsInData: true
                },
                //licenseKey: 'SVpRTWRaSHp5WmRCRFNZSy9zaFI4RkZ0WTBFWWJEOUplOUttUjBZelN4VlBkZkdYUUdtTzhzYWtwUUNBYUE9PS1NakF5TkRFeE1qST0=',
                height: 'auto', // Set the height to auto
                resizeOptions: {
                    horizontal: true, // Enable horizontal resizing
                    vertical: true // Enable vertical resizing
                }
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
});
