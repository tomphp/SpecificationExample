Specification Pattern with Visitor Pattern Example
==================================================
This is an example of how we are currently combining the Specification Pattern
with the Visitor Pattern to build repositories in some of our PHP projects.

This is not a library to be used as is, it's just an example for reference.

Credit goes to [https://github.com/robteifi Rob Heyes] for choosing to use the
Visitor Pattern.

Reasoning
---------
The reason the Specification Pattern is so nice to use here is because it allows
the entity querying langauge to be specified, designed and tested in the business
layer of the application regardless of the underlying storage layer.

The visitor pattern is then used to ensure that no storage layer specific
information is leaked into the business layer.

The persistence layers are easily tested be comparing the full entity set
filtered with a given specification against the databases implementation of
`fetchBySpecification()` with the given specification.

Reading the Code
----------------
There are 2 example repositories provided in the code, `MemoryRepository` and
`SQLiteRepository`. Everything is these namespaces is self contained and not
referenced from anywhere else.

The best place to start to get an understanding of this code is to check the
`TomPHPTest\SpecificationExample\Application\Repository\VideoRepositoryTest` test.

Possible Improvements
---------------------
There are a few improvements which could be made here.

One would be to use a `trait` to implement the `accept()` method in the
specifications using PHP's dynamic features. I have not done this as I think
the current way is simpler to understand.

Other tweaks and modifications would be required depending on the application.

**If you have any further thoughts, ideas or suggestions please submit an 
issue or PR as I'd love to hear them**
