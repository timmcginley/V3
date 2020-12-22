# V2
This is an experiment to create a minimal design system in JSON with clean URLS and PHP
* it uses JSON schema to know what to read
* it defines four states which are framed in the classes of ...
1. course
2. assumptions (zero)
2. goal
3. system configuration
4. design values and data
* it is very much work in progress...
## how it (should) work
![alt text](https://github.com/timmcginley/V2/blob/master/docs/speckle.JPG "Speckle modular design concept")
Ultimately this is coming from the speckle objects. For instance in the image above. The project is defined as **AGILE F20**. This project is then seperated into
* the initial assumptions.
* the current configuration of the design and design systems.
* the resulting values / state of play of the project.
## State of play
This component provides data about the current state of the system. It will be derived from the design systems and project information defined in the design config section or if these are not available it can get the data from the assumptions, if the assumptions are not available it will take these from the zero system. This is the same class as the assumptions but it is popualted by data from the design systems.
## Zero Building
This is what the state of play reads if no values are present, not even for the project. state of play can still tell you something even if you know nothing. We call this approach the zero design system. Another way to think about this would be that it is LOD 0 (ZERO building).
## Assumptions
Assumptions are important because they enable the investigation work of design systems that rely on the *guidance* contained in that assumption to start on their own work. they are more project or typology specific than teh zero building. This is the same class as state of play with the difference that the data is already instantiated as a best guess. This is LOD 100 = ZERO BUILD + PROJECT BASED ASSUMPTIONS. Not sure if this is hard coded or inferred from other data points.
## Design config
The idea here is that the design is made up from explicitly referenced design system micro services. These services are configure here and data is placed about teh project, if the project data is not availble here, it can be sourced from the assumptions.
