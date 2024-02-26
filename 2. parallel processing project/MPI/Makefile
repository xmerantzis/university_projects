DIM ?= 16
KNN ?= 32
TRA ?= 1048576
QUE ?= 1024

LOW ?=  0
HIGH ?= 2


CFLAGS  = -DPROBDIM=$(DIM) -DNNBS=$(KNN) -DTRAINELEMS=$(TRA) -DQUERYELEMS=$(QUE) -DLB=$(LOW) -DUB=$(HIGH) -g -ggdb -O3
CFLAGS += -DSURROGATES -Wall
LDFLAGS += -lm

all: gendata myknnMPI

gendata: gendata.o
	gcc -o gendata gendata.o $(LDFLAGS)

gendata.o: gendata.c func.c
	gcc $(CFLAGS) -c gendata.c

myknnMPI: myknnMPI.o
	mpicc -o myknnMPI myknnMPI.o $(LDFLAGS)

myknnMPI.o: myknnMPI.c func.c
	mpicc $(CFLAGS) -c myknnMPI.c

clean:
	rm -f myknn *.o gendata
