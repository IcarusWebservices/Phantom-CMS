# CSS Usage
_A quick start guide on using CSS components in the admin panel._
- - -
# Table of components
1. [Macro components](#macro-comp)
    1. [Modals](#modals)
    2. [Containers](#containers)
    3. [Tables](#tables)
2. [Micro components](#micro-comp)
    1. [Buttons](#buttons)
    2. [Tags](#tags)
    3. [Attention bubbles/badges](#badges)
    4. [Input styles](#input)
        1. [Radio buttons](#radio)


# Macro components <a name="macro-comp"></a>
> Main standalone UI Components. Examples include tables and modals.

## Modals <a name="modals"></a>
Modals consist out of the following required elements:

| Element | Class
|---|---|
| Modal background | `.modal` |
| Modal content | `.modal-content` |
| Modal header | `.modal-header` |
| Modal body | `.modal-body` |
| Modal footer | `.modal-footer` |

Use the example below for features like right-aligned action buttons and a circular header icon


HTML Example:
```html
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <i class="fas fa-times close-modal"></i>
            <i class="fas fa-users circle-icon"></i>
        </div>
        <div class="modal-body">
            <p>Enter your content here!</p>
        </div>
        <div class="modal-footer">
            <div class="action">
            <a href="#" class="button semi-rounded outline">Cancel</a>
            <a href="#" class="button semi-rounded">Action</a>
        </div>
    </div>
</div>
```


## Containers <a name="containers"></a>
HTML Example:
```html
<div class="container">
    <h1>Your title</h1>
    <p>Enter your content here!</p>
</div>
```


## Tables <a name="tables"></a>
Currently, there is one table style available, which is automatically applied to all `<table>` elements.

HTML Example:
```html
<table>
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>John</th>
            <th>Doe</th>
            <th>john@doe.com</th>
        </tr>
        <tr>
            <th>Jane</th>
            <th>Doe</th>
            <th>jane@doe.com</th>
        </tr>
    </tbody>
</table>
```



# Micro components <a name="micro-comp"></a>
> Small standalone UI components. Examples include buttons, form elements and tags

## Buttons <a name="buttons"></a>
The buttons in the Phantom components are easily customized by adding classes. All classes can be combined.
| Shapes | Class |
|---|---|
| Square | _default_ |
| Slightly rounded | `.semi-rounded` |
| Round | `.rounded` |

| States | Class |
|---|---|
| Enabled | _default_ |
| Disabled | `.disabled` |

| Sizes | Class |
|---|---|
| Medium | _default_ |
| Small | `.small` |

| Colors | Class |
|---|---|
| Green | _default_ |
| Red | `.red` |
| Orange | `.orange` |
| Blue | `.blue` |
| Purple | `.purple` |

Misc options: `.outline`

HTML Example:
```html
<a class="button small rounded purple outline" href="#">Button</a>
```


## Tags <a name="tags"></a>
Supported colors: `.red`, `.green`, `.blue`, `.yellow`

HTML Example:
```html
<span class="tag red">Your tag!</span>
```


## Attention bubbles/badges <a name="badges"></a>
To be used on top of FontAwesome icons, for instance on a notification bell or on an email icon.
If you don't need a number in the bubble, set `data-count` to "` `" (space).

HTML Example:
```html
<i class="far fa-bell badge" data-count="3"></i>
```


## Input <a name="input"></a>
_Most_ input styles are to be applied onto **form** elements as a class.
The `.form` class is required to indicate you want the form to be styled.

All current styles: `.rounded`, `.flat`

Note that the use of `.field` is only required for the following style(s): `.flat`

HTML Example:
```html
<form class="form rounded">
    <div class="field">
        <input type="text" name="username" autocomplete="off">
        <label for="username">Username</label>
    </div>
    <div class="field">
        <input type="text" name="username" autocomplete="off">
        <label for="username">Username</label>
    </div>
</form>
```


## Input: Radio buttons <a name="radio"></a>
HTML Example:
```html
<label class="control control-radio">Your label here!
    <input type="radio" name="bool">
    <div class="control-indicator"></div>
</label>
```
