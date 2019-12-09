<?php
return [
    'alipay' => [
        'app_id' => '2016080300153702',
        'ali_public_key' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB',
        'private_key' => 'MIIEogIBAAKCAQEAmvKMVbsbPK9KovKMC0GFAifmZrrXtDWmlyhakQ+YF7Pjp/eHCCF6NXiOlPbs12+L4gltYTNL6eXzgikQq8sE9KwlMyXahElA+5MoEI5zKyPnBWJbISLElinh/Y+bEOVcShQ+xas9agtRmh7mmoF8wEp54boU0lwq1wvIhWCRu6yQoYO3v/r+GFF0s7UxEJ5HtyLswj+g/7LqNtj3Ir8p7slpDhxVI1hDKEh6UNnpwChwiyxFxvV7eQUgkhPK56AZ0w8AkIsPzEPnDTjFRF/OG3g97DuYcabVVGaNGwzRI8h1gGng3bFS+j1J0wXwdUxvQ+76ggbeeFCUhBHzplSzRwIDAQABAoIBAG/73irTuIKqWbHcxBQafUuqlJ0oal8G62iRtKrkb1KqI12wyrm4oD9m6v2EXHXzW1C46YF3dmUMWWp3zWGrr+A5TgViVUSIQNvRZgJZQakrIHtGs4AGRbgVewwrrrGOYp3zdc6czR0IIyjVLmr6LLQ430+hkgzaqeeTz4991LWig0qAOcMZjJd5a806f1XCWGiZ0EQnFh5C8KAvuwE2Jp3jJK+TpV+2WpbdMS1oOaig3uY3zvcUfCRKr6UZ1Z8TsQwNxuTBLrkP5HK2B8rDNQ4wBVRf2rB004r6bFfF6/GqoNQ4lvYDWS1ZmvEk4J7wDFTRkQyxEH1+4dgFndXoIdECgYEA9II7gEQ9cN3MtiC28NqAnRoX7ZJeIOZy/I6vOwtStu4kZJ5ddm3wvqxY6cpPwKN5/4EiYc7s7hIuF3Yna1aROxS7qExtoBXdjnARHsBmw8tJRAVickkK1p3+CAC4+9f8bDthNJjO5pGNshAq9Xo4bAnrA7NYqT0disRtVaDUv38CgYEAojrGER+dBCgM1jCXVDPWNrDbGvUO4iEwaWObLmHoJSw1eCDl52iQt4l54SQM9Q2vf4CHyMnfqeAnBaawm69iBzi9mUXGG54K0sVMpjQCHxOSwefQkNqSUgCJKHJaxkc81nyVHzoGRG5Vy5mr6TSMsLeWKQGM2SrsY8AcW1QR8DkCgYAvMvCfewzNO9OnmLsX1WYcbYwO7UFEYpfxzu1enXnzHBdkYPmzwddGR2jGgKpSinwjaV8kuFgeQN4q40EKxGQ2nnL3MwG6dF4Xf+SeJg/wXc6f1dZCL31rHoaKLvGGlBQDJJdIGvNdqN1McTiJuHUpzeRTC4zi5oxMXEyqyegnqwKBgGRsj5mgATnGdRPOJo9YO13FowyP8HOo6egDYdeXgfYo5LyFWOwj/Zmv/4OQJnk3zJDYBrYTyWHGQUGtSxxEuCESTcPovlbwQXDx853bCgkku69PCfvxYaxjaoRgLbMZ/B4mJsWazLBlwLR1X0bQYdsu+kROEluIx6aEEMm0RBp5AoGAUXNpXefUaZLFk4o4fqnfl79xCQoIiE/l3inFL7IoouDObI5GoIEjKTislmnQPO5LXrSxtLHgp4sUmxZ2eLFbOzw5nNPDzf+vV+WuX+okoCFTuVqKSoJJY1FXQB4H5W7ABn0t5Q61EZoN0iXWarRBsOGAge9zl6rWB2FC3zo3334=',

        'log' => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],
    'wechat' => [
        'app_id' => '',
        'mch_id' => '',
        'key' => '',
        'cert_client' => '',
        'cert_key' => '',
        'log' => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];