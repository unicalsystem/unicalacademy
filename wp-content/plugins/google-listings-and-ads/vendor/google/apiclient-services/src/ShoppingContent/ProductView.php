<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Service\ShoppingContent;

class ProductView extends \Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Collection
{
  protected $collection_key = 'itemIssues';
  /**
   * @var string
   */
  public $aggregatedDestinationStatus;
  /**
   * @var string
   */
  public $availability;
  /**
   * @var string
   */
  public $brand;
  /**
   * @var string
   */
  public $categoryL1;
  /**
   * @var string
   */
  public $categoryL2;
  /**
   * @var string
   */
  public $categoryL3;
  /**
   * @var string
   */
  public $categoryL4;
  /**
   * @var string
   */
  public $categoryL5;
  /**
   * @var string
   */
  public $channel;
  /**
   * @var string
   */
  public $condition;
  /**
   * @var string
   */
  public $creationTime;
  /**
   * @var string
   */
  public $currencyCode;
  /**
   * @var Date
   */
  public $expirationDate;
  protected $expirationDateType = Date::class;
  protected $expirationDateDataType = '';
  /**
   * @var string[]
   */
  public $gtin;
  /**
   * @var string
   */
  public $id;
  /**
   * @var string
   */
  public $itemGroupId;
  /**
   * @var ProductViewItemIssue[]
   */
  public $itemIssues;
  protected $itemIssuesType = ProductViewItemIssue::class;
  protected $itemIssuesDataType = 'array';
  /**
   * @var string
   */
  public $languageCode;
  /**
   * @var string
   */
  public $offerId;
  /**
   * @var string
   */
  public $priceMicros;
  /**
   * @var string
   */
  public $productTypeL1;
  /**
   * @var string
   */
  public $productTypeL2;
  /**
   * @var string
   */
  public $productTypeL3;
  /**
   * @var string
   */
  public $productTypeL4;
  /**
   * @var string
   */
  public $productTypeL5;
  /**
   * @var string
   */
  public $shippingLabel;
  /**
   * @var string
   */
  public $title;

  /**
   * @param string
   */
  public function setAggregatedDestinationStatus($aggregatedDestinationStatus)
  {
    $this->aggregatedDestinationStatus = $aggregatedDestinationStatus;
  }
  /**
   * @return string
   */
  public function getAggregatedDestinationStatus()
  {
    return $this->aggregatedDestinationStatus;
  }
  /**
   * @param string
   */
  public function setAvailability($availability)
  {
    $this->availability = $availability;
  }
  /**
   * @return string
   */
  public function getAvailability()
  {
    return $this->availability;
  }
  /**
   * @param string
   */
  public function setBrand($brand)
  {
    $this->brand = $brand;
  }
  /**
   * @return string
   */
  public function getBrand()
  {
    return $this->brand;
  }
  /**
   * @param string
   */
  public function setCategoryL1($categoryL1)
  {
    $this->categoryL1 = $categoryL1;
  }
  /**
   * @return string
   */
  public function getCategoryL1()
  {
    return $this->categoryL1;
  }
  /**
   * @param string
   */
  public function setCategoryL2($categoryL2)
  {
    $this->categoryL2 = $categoryL2;
  }
  /**
   * @return string
   */
  public function getCategoryL2()
  {
    return $this->categoryL2;
  }
  /**
   * @param string
   */
  public function setCategoryL3($categoryL3)
  {
    $this->categoryL3 = $categoryL3;
  }
  /**
   * @return string
   */
  public function getCategoryL3()
  {
    return $this->categoryL3;
  }
  /**
   * @param string
   */
  public function setCategoryL4($categoryL4)
  {
    $this->categoryL4 = $categoryL4;
  }
  /**
   * @return string
   */
  public function getCategoryL4()
  {
    return $this->categoryL4;
  }
  /**
   * @param string
   */
  public function setCategoryL5($categoryL5)
  {
    $this->categoryL5 = $categoryL5;
  }
  /**
   * @return string
   */
  public function getCategoryL5()
  {
    return $this->categoryL5;
  }
  /**
   * @param string
   */
  public function setChannel($channel)
  {
    $this->channel = $channel;
  }
  /**
   * @return string
   */
  public function getChannel()
  {
    return $this->channel;
  }
  /**
   * @param string
   */
  public function setCondition($condition)
  {
    $this->condition = $condition;
  }
  /**
   * @return string
   */
  public function getCondition()
  {
    return $this->condition;
  }
  /**
   * @param string
   */
  public function setCreationTime($creationTime)
  {
    $this->creationTime = $creationTime;
  }
  /**
   * @return string
   */
  public function getCreationTime()
  {
    return $this->creationTime;
  }
  /**
   * @param string
   */
  public function setCurrencyCode($currencyCode)
  {
    $this->currencyCode = $currencyCode;
  }
  /**
   * @return string
   */
  public function getCurrencyCode()
  {
    return $this->currencyCode;
  }
  /**
   * @param Date
   */
  public function setExpirationDate(Date $expirationDate)
  {
    $this->expirationDate = $expirationDate;
  }
  /**
   * @return Date
   */
  public function getExpirationDate()
  {
    return $this->expirationDate;
  }
  /**
   * @param string[]
   */
  public function setGtin($gtin)
  {
    $this->gtin = $gtin;
  }
  /**
   * @return string[]
   */
  public function getGtin()
  {
    return $this->gtin;
  }
  /**
   * @param string
   */
  public function setId($id)
  {
    $this->id = $id;
  }
  /**
   * @return string
   */
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param string
   */
  public function setItemGroupId($itemGroupId)
  {
    $this->itemGroupId = $itemGroupId;
  }
  /**
   * @return string
   */
  public function getItemGroupId()
  {
    return $this->itemGroupId;
  }
  /**
   * @param ProductViewItemIssue[]
   */
  public function setItemIssues($itemIssues)
  {
    $this->itemIssues = $itemIssues;
  }
  /**
   * @return ProductViewItemIssue[]
   */
  public function getItemIssues()
  {
    return $this->itemIssues;
  }
  /**
   * @param string
   */
  public function setLanguageCode($languageCode)
  {
    $this->languageCode = $languageCode;
  }
  /**
   * @return string
   */
  public function getLanguageCode()
  {
    return $this->languageCode;
  }
  /**
   * @param string
   */
  public function setOfferId($offerId)
  {
    $this->offerId = $offerId;
  }
  /**
   * @return string
   */
  public function getOfferId()
  {
    return $this->offerId;
  }
  /**
   * @param string
   */
  public function setPriceMicros($priceMicros)
  {
    $this->priceMicros = $priceMicros;
  }
  /**
   * @return string
   */
  public function getPriceMicros()
  {
    return $this->priceMicros;
  }
  /**
   * @param string
   */
  public function setProductTypeL1($productTypeL1)
  {
    $this->productTypeL1 = $productTypeL1;
  }
  /**
   * @return string
   */
  public function getProductTypeL1()
  {
    return $this->productTypeL1;
  }
  /**
   * @param string
   */
  public function setProductTypeL2($productTypeL2)
  {
    $this->productTypeL2 = $productTypeL2;
  }
  /**
   * @return string
   */
  public function getProductTypeL2()
  {
    return $this->productTypeL2;
  }
  /**
   * @param string
   */
  public function setProductTypeL3($productTypeL3)
  {
    $this->productTypeL3 = $productTypeL3;
  }
  /**
   * @return string
   */
  public function getProductTypeL3()
  {
    return $this->productTypeL3;
  }
  /**
   * @param string
   */
  public function setProductTypeL4($productTypeL4)
  {
    $this->productTypeL4 = $productTypeL4;
  }
  /**
   * @return string
   */
  public function getProductTypeL4()
  {
    return $this->productTypeL4;
  }
  /**
   * @param string
   */
  public function setProductTypeL5($productTypeL5)
  {
    $this->productTypeL5 = $productTypeL5;
  }
  /**
   * @return string
   */
  public function getProductTypeL5()
  {
    return $this->productTypeL5;
  }
  /**
   * @param string
   */
  public function setShippingLabel($shippingLabel)
  {
    $this->shippingLabel = $shippingLabel;
  }
  /**
   * @return string
   */
  public function getShippingLabel()
  {
    return $this->shippingLabel;
  }
  /**
   * @param string
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }
  /**
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ProductView::class, 'Google_Service_ShoppingContent_ProductView');
