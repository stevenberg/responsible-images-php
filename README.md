# Responsible Images

A PHP for generating responsive image URLs and HTML tags.

## Installation

Install with composer:

```bash
composer require stevenberg/responsible-images
```

Use Cloudinary images with
[stevenberg/responsible-images-cloudinary](https://github.com/stevenberg/responsible-images-cloudinary-php):

```bash
composer require stevenberg/responsible-images-cloudinary
```

## Example

Here's an example of using the library in a Laravel project:

```php
// app/Providers/ResponsibleImagesServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use StevenBerg\ResponsibleImages\Urls\Cloudinary;
use StevenBerg\ResponsibleImages\Urls\Maker;

class ResponsibleImagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Maker::registerDefaultMaker(new Cloudinary);
    }
}
```

```php
// app/Image.php

namespace App;

use Illuminate\Database\Eloquent\Model;
use StevenBerg\ResponsibleImages\Image as ResponsibleImage;
use StevenBerg\ResponsibleImages\Urls\Cloudinary;
use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Name;
use StevenBerg\ResponsibleImages\Values\Shape;

class Image extends Model
{
    protected $fillable = ['gravity', 'name', 'shape'];

    public function getGravityAttribute($value)
    {
        return Gravity::from($value);
    }

    public function setGravityAttribute(Gravity $value)
    {
        $this->attributes['gravity'] = $value->value();
    }

    public function getNameAttribute($value)
    {
        return Name::from($value);
    }

    public function setNameAttribute(Name $value)
    {
        $this->attributes['name'] = $value->value();
    }

    public function getShapeAttribute($value)
    {
        return Shape::from($value);
    }

    public function setShapeAttribute(Shape $value)
    {
        $this->attributes['shape'] = $value->value();
    }

    public function getResponsiveImageAttribute()
    {
        return ResponsibleImage::fromShape(
            $this->shape,
            $this->name,
            ['gravity' => $this->gravity]
        );
    }
}
```

```php
// app/helpers.php

use App\Image;
use StevenBerg\ResponsibleImages\SizeRange;

function responsive_image_tag(
    Image $image,
    int $min,
    int $max,
    int $step,
    array $attributes)
{
    $range = SizeRange::from($min, $max, $step);

    echo $image->responsive_image->tag($range, $range->first(), $attributes);
}
```

## License

Copyright © 2017 [Steven Berg](mailto:steven@stevenberg.net)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
