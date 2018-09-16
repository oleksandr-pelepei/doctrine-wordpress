The library is frozen at the moment. I faced an issue in the Term entity realization. 
This entity must have association with the Taxonomy entity, but term_id collumn in
Taxonomy entity is not index and Doctrine does not allow association on noidex columns.
You can read about this issue more [here](https://stackoverflow.com/questions/24059666/doctrine-2-mapping-referencing-unique-key).
