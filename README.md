#Faker Context
## By [Edmonds Commerce](https://www.edmondscommerce.co.uk)

A simple Behat Context to allow you to use Faker when running your Behat features

### Installation

Install via composer

"edmondscommerce/behat-faker-context": "~1.1"


### Include Context in Behat Configuration

```
default:
    # ...
    suites:
        default:
            # ...
            contexts:
                - # ...
                - EdmondsCommerce\BehatFakerContext\BehatFakerContext

```
