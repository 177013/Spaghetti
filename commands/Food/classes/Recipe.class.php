<?php
class Recipe {
	protected $title;
	protected $href;
	protected $ingredients;
	protected $thumbnail;

	public function __construct() {
		$this->title = null;
		$this->href = null;
		$this->ingredients = null;
		$this->thumbnail = null;

		return $this;
	}

	public static function search(string $query = null, string $ingredients = null) : array {
		$result = [];

		$searchQuery = "http://www.recipepuppy.com/api/?q=$query";
		$recipes = file_get_contents($searchQuery);
		$recipes = json_decode($recipes, true);

		foreach( $recipes['results'] as $recipe ) {
			$temp = (new Recipe())
				->setTitle( $recipe['title'] )
				->setHref( $recipe['href'] )
				->setIngredients( $recipe['ingredients'] )
				->setThumbnail( $recipe['thumbnail'] );
			array_push($result, clone $temp);
		}

		return $result;
	}

    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle() : string {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle(string $title) : Recipe {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the value of href.
     *
     * @return mixed
     */
    public function getHref() : string {
        return $this->href;
    }

    /**
     * Sets the value of href.
     *
     * @param mixed $href the href
     *
     * @return self
     */
    public function setHref(string $href) : Recipe {
        $this->href = $href;

        return $this;
    }

    /**
     * Gets the value of ingredients.
     *
     * @return mixed
     */
    public function getIngredients() : string {
        return $this->ingredients;
    }

    /**
     * Sets the value of ingredients.
     *
     * @param mixed $ingredients the ingredients
     *
     * @return self
     */
    public function setIngredients(string $ingredients) : Recipe {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * Gets the value of thumbnail.
     *
     * @return mixed
     */
    public function getThumbnail() : string {
        return $this->thumbnail;
    }

    /**
     * Sets the value of thumbnail.
     *
     * @param mixed $thumbnail the thumbnail
     *
     * @return self
     */
    public function setThumbnail(string $thumbnail) : Recipe {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}