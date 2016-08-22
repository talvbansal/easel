Welcome to Easel! I'm your first post demonstrating Markdown integration. Don't delete me, I'm very helpful! If you do delete me though, I can be recovered. Just grab me from:

```
/vendor/talv86/easel/resources/views/shared/helpers/welcome.blade.php
```

<div class="section-divider"></div>

## The Basics
---

Before I tell you about all the extra syntaxes and capabilities you have available to you, I'll introduce you to the basics of standard markdown. If you already know markdown, and want to jump straight to learning about the fancier things I can do, feel free to skip this section. Lets jump right in!

Markdown is a plain text formatting syntax created by John Gruber, aiming to provide a easy-to-read and feasible markup. The original Markdown syntax specification can be found [here](http://daringfireball.net/projects/markdown/syntax).

<div class="section-divider"></div>

## Typography
---

# Header 1
## Header 2
### Header 3
#### Header 4
##### Header 5
###### Header 6

Just put angle brackets around an email and it becomes clickable: <user@example.com> `<user@example.com>`

Same thing with urls: <http://example.com> `<http://example.com>`

Perhaps you want to some link text like this: [Example Website](http://example.com "Title")
`[Example Website](http://example.com "Title")` (The title is optional)

Make [a link][arbitrary_id] `[a link][arbitrary_id]` then on it's own line anywhere else in the file:
`[arbitrary_id]: http://example.com "Title"`

If the link text itself would make a good id, you can link [like this][] `[like this][]`, then on it's own line anywhere else in the file:
`[like this]: http://example.com`

[arbitrary_id]: http://example.com "Title"
[like this]: http://example.com

Option name         | Markup           | Result                  |
--------------------|------------------|-------------------------|
Intra-word emphasis | `Intra-word em\*pha\*sis`   | Intra-word em<em>pha</em>sis   |
Strikethrough       | `\~~Strikethrough\~~`   | <del>Strikethrough</del>   |
Underline  | `\_Underline\_`      | <u>Underline</u>        |
Quote      | `\"Quote\"`  | <q>Quote</q>    |
Highlight           | `\==Highlight\==`    | <mark>Highlight</mark>  |
Superscript         | `Some\^(superscript)`     | Some<sup>superscript</sup>   |
Italics            | `**Italics**`      | <em>Italics</em>        |
Bold | `*Bold text*`   | <strong>Bold text</strong>   |
HTML Entities | ``&copy;`` ``&#402;`` ``&#8482;`` ``&reg;`` | © ƒ ™ ®

<div class="section-divider"></div>

## Tables
---

##### **Markup**:
```
Key | Value
--- | ---
SSH Host | `example.com`
SSH User | `username`
SSH Password | `secret`
Database Host | `127.0.0.1`
Database User | `username`
Database Password | `secret`
```

<div class="section-divider"></div>

##### **Result**:
Key                 | Value
------------------- | ---
SSH Host            | `example.com`
SSH User            | `username`
SSH Password        | `secret`
Database Host       | `127.0.0.1`
Database User       | `username`
Database Password   | `secret`

<div class="section-divider"></div>

## Code Blocks
---

`Inline code` is indicated by surrounding it with backticks:
`` `Inline code` ``

If your ``code has `backticks` `` that need to be displayed, you can use double backticks:
```` ``Code with `backticks` `` ````  (mind the spaces preceding the final set of backticks)

GitHub's fenced code blocks are supported in Easel:

```
namespace App;

class Blog extends Easel
{

    /**
    * Dreaming of something more?
    *
    * @with Easel
    */
    public function create()
    {
        // Make something awesome...
    }
}
```

You can also use waves (`~`) instead of back ticks (`` ` ``):

~~~
print('Hello world!')
~~~

<div class="section-divider"></div>

## Lists
---

##### **Markup**:
```
* Lists must be preceded by a blank line (or block element)
* Unordered lists start each item with a `*`
- `-` Works too
  * Indent a level to make a nested list
    1. Ordered lists are supported.
    2. Start each item (number-period-space) like `1.`
    42. It doesn't matter what number you use, it will render sequentially
```

<div class="section-divider"></div>

##### **Result**:
* Lists must be preceded by a blank line (or block element)
* Unordered lists start each item with a `*`
- `-` Works too
  * Indent a level to make a nested list
    1. Ordered lists are supported.
    2. Start each item (number-period-space) like `1`
    3. It doesn't matter what number you use, it will render sequentially

<div class="section-divider"></div>

## Block Quotes
---

##### **Markup**:
```
> Angle brackets `>` are used for block quotes.
Technically not every line needs to start with a `>` as long as
there are no empty lines between paragraphs.
> Looks kinda ugly though.
> > Block quotes can be nested.
> > > Multiple Levels
>
> Most markdown syntaxes work inside block quotes.
```

<div class="section-divider"></div>

##### **Result**:
> Angle brackets `>` are used for block quotes.
Technically not every line needs to start with a `>` as long as
there are no empty lines between paragraphs.
> Looks kinda ugly though.
> > Block quotes can be nested.
> > > Multiple Levels
>
> Most markdown syntaxes work inside block quotes.

<div class="section-divider"></div>

## Horizontal Rules
---

If you type three asterisks `***`, you will get a horizontal rule. Three dashes `---` will make the same rule.

<div class="section-divider"></div>

## Task List Syntax
---

1. [x] Support for rendering checkbox list syntax
  * [x] Support for nesting
  * [x] Support for ordered *and* unordered lists
2. [ ] No support for clicking checkboxes directly in the HTML window

<div class="section-divider"></div>

## Markdown Extra
---

Easel supports **Markdown Extra**, which extends traditional **Markdown** syntax with some nice features. If you need some help or just want a refresher, read more about [Markdown syntax](https://daringfireball.net/projects/markdown/syntax) and [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).

<div class="section-divider"></div>

## Hack On
---

That’s about it. The best way to be proficient in anything is to know what tools you have available to you. You're one step ahead of the game now. Happy coding!
