# baokao
A free and open-source web application to view, edit and collaborate on study resources.

## design principles

- as fast as possible
- maintainable
- lightweight
- top-notch user experience
- client over server
- just *works*

## features

- some of the worst javascript code you'll ever see
- yes, that is php communicating with javascript - I know it's painful
- if-else-switch-party over here

Over time I'll try and actually put effort into abstraction, but we hav enough currentlyto launch a working deployment.

## why PHP?
Because I hate high-quality maintainable code that uses the industry-standard MVC model which emphasises best coding practices, plus I'm hoping it uses less than 512 MB of RAM (thx heroku), oh and also I only have ~~two weeks~~ to get this running and I sort of want to finish my playthrough of Fire Emblem (the one with Roy in it). 

## dependencies

- [Primer CSS](https://primer.style) — MIT License
- [Hover](https://github.com/IanLunn/Hover) — MIT License
- [Axios](https://axios-http.com) — MIT License
- [DOMPurify](https://github.com/cure53/DOMPurify) — MPL-2.0 / Apache-2.0

## setup

### environment

- `baokao/public/static/env.js`

### keys

Create a API key at https://console.cloud.google.com/apis/credentials and then fill it in `baokao/public/static/env.js`.

- Google Drive API key should be restricted in production with a HTTP restriction to your domain (https://cloud.google.com/docs/authentication/api-keys#adding_http_restrictions) and API restriction (Google Drive API)
- Keys exposed to the client should only have access to the free Google Drive API and be restricted by HTTP domain or IP address.
- Exposing API keys to the client is pretty poor security practice. Too bad!

## license

MIT License - see LICENSE for more info.

MIT huh? I wouldn't mind going there one day :)