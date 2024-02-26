DIM ?= 16
KNN ?= 32
TRA ?= 1048576
QUE ?= 1024

LOW ?=  0
HIGH ?= 2


CFLAGS  = -DPROBDIM=$(DIM) -DNNBS=$(KNN) -DTRAINELEMS=$(TRA) -DQUERYELEMS=$(QUE) -DLB=$(LOW) -DUB=$(HIGH) -g -ggdb -O3
CFLAGS += -DSURROGATES -Wall -fopenmp
LDFLAGS += -lm

all: gendata myknnOMP

gendata: gendata.o
	gcc -o gendata gendata.o $(LDFLAGS)

gendata.o: gendata.c func.c
	gcc $(CFLAGS) -c gendata.c

myknnOMP: myknnOMP.o
	gcc -fopenmp -o myknnOMP myknnOMP.o $(LDFLAGS)

myknnOMP.o: myknnOMP.c func.c
	gcc -fopenmp $(CFLAGS) -c myknnOMP.c

clean:
	rm -f myknn *.o gendata
