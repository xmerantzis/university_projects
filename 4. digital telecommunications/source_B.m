% source B
temp = randn(10000,1);
a = [1 1/2 1/3 1/4 1/5 1/6];
sourceB = filter(1, a, temp);

for n = 2:4
    [xq, centers, D] = lloydMaxQuantizer(sourceB, n, -1, 1);
    %convert digitized output
    digitalSourceB = centers(xq);
    digitalSourceB = digitalSourceB';
    %Calculate SQNR
    for i=1:length(D)
        SQNR(i) = (mean(sourceB.^2))/D(i);
    end
    plot(SQNR)
    %Calculate MSE
    MSE = immse(digitalSourceB, sourceB);
    fprintf('MSE of %d-bit Lloyd-Max quantization is %f\n', n, MSE);
end

for n = 2:4
    [idx, C, sumd] = kmeans(sourceB, n);
    %convert digitized output
    C = C';
    digitalSourceB = C(idx);
    digitalSourceB = digitalSourceB';
    Dist = min(sumd)/length(sourceB);

    %Calculate SQNR
    Dist = min(sumd)/length(sourceB);
    SQNR = (mean(sourceB.^2))/Dist;
    %Calculate MSE
    MSE = immse(digitalSourceB, sourceB);
    fprintf('SQNR of %d-bit Kmeans quantization is %f dBs\n', n, SQNR);
    fprintf('MSE of %d-bit kmeans quantization is %f\n', n, MSE);
end