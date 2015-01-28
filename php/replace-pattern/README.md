Replace pattern
================

You can use this snippet to replace a list of fixed pattern from a string.
  
For example, you could create your own simplified regexp: 

```php
replacePattern('/route/**/*.php', ['**', '*'], ['.*', '[^/]*']);
// return "/route/.*/[^/]*.php"
```

This snippet handle the escaped characters: 

```php
replacePattern('/route/\*', ['**', '*'], ['.*', '[^/]*']);
// return "/route/*"
replacePattern('/route/\\\\\*', ['**', '*'], ['.*', '[^/]*']);
// return "/route/\*"
```