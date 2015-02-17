#Faker Context
## By [Edmonds Commerce](https://www.edmondscommerce.co.uk)

A simple Behat Context to allow you to use Faker when running your Behat features

### Installation

Install via composer

"edmondscommerce/faker-context": "dev-master"


### Include Context in Behat Configuration

```
default:
    # ...
    suites:
        default:
            # ...
            contexts:
                - # ...
                - EdmondsCommerce\FakerContext\FakerContext

```
